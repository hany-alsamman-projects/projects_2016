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

            $dest = base_path() .'/' . 'assets/admin/data/avatars';

            Input::file('upload_photo')->move($dest,$avatar_name);

            @chmod($dest.'/'.$avatar_name,0777);

            }

            // Create the user
            $user = Sentry::createUser(array(
                'first_name'     => Input::get( 'first_name' ),
                'email'     => Input::get( 'email' ),
                'password'  => Input::get( 'password' ),
                'phone_number'  => Input::get( 'phone_number' ),
                'activated' => (Input::get( 'activated' ) == 1) ? true : false,
                'avatar' => (Input::hasFile('upload_photo')) ? $avatar_name : false,
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupById(Input::get( 'group_id' ));
            // Assign the group to the user
            $user->addGroup($adminGroup);

            if ($user->save()) {
                return Redirect::back()->with('flash_error', 'New User Created successfully');
            } else {
                return Redirect::back()->with('flash_error', 'New User not created');
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
     * @param $user
     * @return Response
     */
    public function getEdit($user)
    {

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        if ( $user->id )
        {
            $roles = $this->role->all();
            $permissions = $this->permission->all();

            // Title
        	$title = Lang::get('admin/users/title.user_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/users/create_edit', compact('user', 'roles', 'permissions', 'title', 'mode'));
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
    public function postEdit($user)
    {
        // Validate the inputs
        $validator = Validator::make(Input::all(), $user->getUpdateRules());


        if ($validator->passes())
        {
            $oldUser = clone $user;
            $user->username = Input::get( 'username' );
            $user->email = Input::get( 'email' );
            $user->confirmed = Input::get( 'confirm' );

            $password = Input::get( 'password' );
            $passwordConfirmation = Input::get( 'password_confirmation' );

            if(!empty($password)) {
                if($password === $passwordConfirmation) {
                    $user->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $user->password_confirmation = $passwordConfirmation;
                } else {
                    // Redirect to the new user page
                    return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }
            
            if($user->confirmed == null) {
                $user->confirmed = $oldUser->confirmed;
            }

            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            $user->amend();

            // Save roles. Handles updating.
            $user->saveRoles(Input::get( 'roles' ));
        } else {
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }

        // Get validation errors (see Ardent package)
        $error = $user->errors()->all();

        if(empty($error)) {
            // Redirect to the new user page
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('success', Lang::get('admin/users/messages.edit.success'));
        } else {
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }
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

    /**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $users = User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
                    ->select(array('users.id', 'users.username','users.email', 'roles.name as rolename', 'users.confirmed', 'users.created_at'));

        return Datatables::of($users)
        // ->edit_column('created_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromFormat(\'Y-m-d H\', $test)) }}}')

        ->edit_column('confirmed','@if($confirmed)
                            Yes
                        @else
                            No
                        @endif')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                @if($username == \'admin\')
                                @else
                                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                                @endif
            ')

        ->remove_column('id')

        ->make();
    }
}
