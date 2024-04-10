<?php

namespace Controllers\Cpanel;

use CpanelController;

use DB;
use Input;
use Redirect;
use View;
use Debugbar;
use Sentry;
use Cartalyst\Sentry\Users;
use Cartalyst\Sentry\Groups;

class UsersController extends CpanelController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        // Grab all the users
        $users = Sentry::findAllUsers();

        $groups = Sentry::findAllGroups();

        // Show the page
        $this->layout->content = View::make('admin/users/index', compact('users','groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        //Get all the available groups.
        $groups = Sentry::getGroupProvider()->findAll();

        //Get all the available groups.
        //$user = Sentry::getUserProvider()->findAll();

        //Debugbar::info($user);

        $this->layout->content = View::make('admin/users/create', compact('groups', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {

        try
        {

            if(Input::hasFile('upload_photo')){
                $file = Input::file('upload_photo'); // your file upload input field in the form should be named 'file'

                $extension = Input::file('upload_photo')->getClientOriginalExtension();
                $filename = Input::file('upload_photo')->getClientOriginalName();
                $avatar_name = uniqid() . '.' . $extension;

                $dest = base_path() .'/' . 'upload/avatars';

                Input::file('upload_photo')->move($dest,$avatar_name);

                @chmod($dest.'/'.$avatar_name,0777);
            }

            // Create the user
            $user = Sentry::createUser(array(
                'first_name'     => Input::get( 'first_name' ),
                'email'     => Input::get( 'email' ),
                'password'  => Input::get( 'password' ),
                'activated' => (Input::get( 'activated' )) ? 1 : false,
                'avatar' => (Input::hasFile('upload_photo')) ? $avatar_name : false,
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupById(Input::get( 'group_id' ));
            // Assign the group to the user
            $user->addGroup($adminGroup);

            // Find added user
            $getUserID = Sentry::findUserByLogin(Input::get( 'email' ))->getId();

            /**
             * add user data
             */
            $data = Input::only('unit', 'date_birth', 'address', 'nationality','work_tel', 'mobile_tel', 'fax',
                                'living','marital','spouse_name','spouse_birth','iqama_pass');

            $users_data = array_merge(array('user_id' => $getUserID),$data);

            DB::table('users_data')->insert(array($users_data));

            /**
             * add user cars info
             */
            $car = Input::only('plate_no', 'color', 'make', 'year','driver_name', 'driver_nat', 'iqama_copy','driver_photo');

            $users_cars = array_merge(array('user_id' => $getUserID),$car);

            DB::table('users_cars')->insert(array($users_cars));

            /**
             * add user dependents
             */
            $deps  = Input::only('full_name','gender','dep_date_birth','school','passport_no');

            $full_name = $deps['full_name'];
            $gender = $deps['gender'];
            $dep_date = $deps['dep_date_birth'];
            $school = $deps['school'];
            $passport_no = $deps['passport_no'];

            foreach( $full_name as $key => $n ) {
                DB::table('users_dependents')->insert(
                    array(
                        'full_name' => $full_name[$key],
                        'gender' => $gender[$key],
                        'dep_date_birth' => $dep_date[$key],
                        'school' => $school[$key],
                        'passport_no' => $passport_no[$key],
                        'user_id' => $getUserID
                    )
                );
            }

            /**
            foreach( $deps as $dep){

                $users_dependents = array_merge(array('user_id' => $getUserID),$dep);

                DB::table('users_dependents')->insert(array($users_dependents));
            }
            */

            /**
             * add user pets
             */
            $pets = Input::only('cats', 'dogs', 'info_other', 'certificate','collar','details_other');

            $users_pets = array_merge(array('user_id' => $getUserID),$pets);

            DB::table('users_pets')->insert(array($users_pets));

            if ($user->save()) {
                return Redirect::back()->with('flash_error', 'The New Account Created successfully');
            } else {
                return Redirect::back()->with('flash_error', 'The Account not created!');
            }
        }
        catch (Users\UserExistsException $e)
        {
            return Redirect::back()->with('flash_error', 'User with this email already exists.');
        }
        catch (Groups\GroupNotFoundException $e)
        {
            return Redirect::back()->with('flash_error', 'Please Select Group !');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getShow($user)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $userID
     * @return Response
     */
    public function getEdit($userID)
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        $getUser = Sentry::findUserById($userID);

        if ( $getUser->getId() )
        {
            $user = \User::with('data')->with('dependents')->with('pets')->with('cars')->find($userID);

            $groups = DB::table('groups')->lists('name','id');

            $user_group = $getUser->getGroups()[0]->id;

            Debugbar::info($groups);

            //Debugbar::info(\User::with('data')->with('dependents')->with('pets')->with('cars')->find(1)->getRelations()['dependents'][0]->full_name);

            $this->layout->content = View::make('admin/users/edit', compact('user','user_group','groups'));
        }
        else
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit($userID)
    {
        $user = \User::find($userID);

        /**
         * get user data
         */
        $put_data = Input::only('unit', 'date_birth', 'address', 'nationality','work_tel', 'mobile_tel', 'fax',
            'living','marital','spouse_name','spouse_birth','iqama_pass');
        $user->data()->update($put_data);


        /**
         * get user cars info
         */
        $put_car = Input::only('plate_no', 'color', 'make', 'year','driver_name', 'driver_nat', 'iqama_copy','driver_photo');
        $user->cars()->update($put_car);

        /**
         * get user pets info
         */
        $put_pets = Input::only('cats', 'dogs', 'info_other', 'certificate','collar','details_other');
        $user->pets()->update($put_pets);

        /**
         * add user dependents
         * TODO: if update the row and i add new dep, the script should add it automatic
         */
        $deps  = Input::only('full_name','gender','dep_date_birth','school','passport_no');

        $full_name = $deps['full_name'];
        $gender = $deps['gender'];
        $dep_date = $deps['dep_date_birth'];
        $school = $deps['school'];
        $passport_no = $deps['passport_no'];

        foreach( $full_name as $key => $n ) {
            $user->dependents()->update(
                array(
                    'full_name' => $full_name[$key],
                    'gender' => $gender[$key],
                    'dep_date_birth' => $dep_date[$key],
                    'school' => $school[$key],
                    'passport_no' => $passport_no[$key]
                )
            );
        }

        if(Input::hasFile('upload_photo')){
            $file = Input::file('upload_photo'); // your file upload input field in the form should be named 'file'

            $extension = Input::file('upload_photo')->getClientOriginalExtension();
            $filename = Input::file('upload_photo')->getClientOriginalName();
            $avatar_name = uniqid() . '.' . $extension;

            $dest = base_path() .'/' . 'upload/avatars';

            Input::file('upload_photo')->move($dest,$avatar_name);

            @chmod($dest.'/'.$avatar_name,0777);
        }

        /**
         * get user info
         */
        $put_user = array(
            'first_name'     => Input::get( 'first_name' ),
            'email'     => Input::get( 'email' ),
            //'password'  => $user->password,
            'activated' => (Input::get( 'activated' ) == 1) ? true : false,
            'avatar' => (Input::hasFile('upload_photo')) ? $avatar_name : false,
         );

        $user->update($put_user);

        // Redirect to the new user page
        return Redirect::to('admin/users/' . $user->id . '/edit')->with('flash_error','the account has been updated successfully!');
    }

    /**
     * Remove user page.
     *
     * @param $user
     * @return Response
     */
    public function getDelete($user)
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($user);

            // Delete the user
            $user->delete();

            return Redirect::back()->with('flash_error', 'User was deleted successfully');
        }
        catch (Users\UserNotFoundException $e)
        {
            return Redirect::to('admin/users')->with('flash_error', 'User was not found.');
        }

    }
}
