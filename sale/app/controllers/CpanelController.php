<?php
/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 CODEXC.COM
 * @version 4.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */


class CpanelController extends BaseController
{
    public $layout = 'admin.layout';
    public $message = false;
    public $content;
    public $ok = true;

    public function __construct()
    {
        //$this->beforeFilter('csrf', array('on' => 'post'));

        if (Sentry::check()){
            // Apply the auth filter
            $this->beforeFilter('auth');

            //GarbageCollect::dropOldFiles(public_path().'/cache', 1, true);
        }
    }

    function getDashboard()
    {
        $data['users'] = DB::table("users")->where('activated', 1)->count('id');

        $this->layout->content = View::make('admin.partials.dashboard',$data);
    }

    public function postLogin()
    {
        // Declare the rules for the form validation
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|between:3,32',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try
        {
            // Try to log the user in
            $user = Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

            Session::put('user_name', $user->first_name);
            Session::put('ID', $user->id);

            // Redirect to the users page
            return Redirect::to('/admin')->with('success', Lang::get('auth/message.signin.success'));
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {

        }
        // Ooops.. something went wrong
        return Redirect::back()->with('flash_error', 'Seems something wrong with username or password')->withInput();
    }

}

