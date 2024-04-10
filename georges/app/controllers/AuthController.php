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

class AuthController extends BaseController {

	/**
	 * Account sign in.
	 *
	 * @return View
	 */
	public function getSignin()
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

		// Show the page
		return View::make('frontend.auth.signin');
	}

    public function getUserApprove()
    {
        // Is the user logged in?
        if (Sentry::check())
        {
            if(Request::is('auth/activation')){
                if(Str::length(Input::get('agree')) == 32){
                    $user = Sentry::findUserById(Sentry::getUser()->getId());
                    $user->approved = 1;
                    $user->save();

                    // Data to be used on the email view
                    $data = array('user' => $user);

                    // Send the welcome email
                    Mail::send('emails.welcome', $data, function($m) use ($user)
                    {
                        $m->from('no-replay@vip4it.com', 'vip4it.com');
                        $m->to($user->email, $user->first_name)->subject('');
                    });

                    return Redirect::route('account')->with('success', Lang::get('auth/message.activate.success'));
                }else
                    return View::make('frontend.auth.activation')->with('error', Lang::get('auth/message.activate.success'));
            }
            if(!Sentry::getUser()->approved)
                return Redirect::route('userApprove');

        }
        return Redirect::route('account');
    }

	/**
	 * Account sign in form processing.
	 *
	 * @return Redirect
	 */
	public function postSignin()
	{

        $this->beforeFilter('csrf', array('on' => 'post'));

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
			return Redirect::route('signin')->withInput()->withErrors($validator);
		}

		try
		{
			// Try to log the user in
            $user = Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

			// Get the page we were before
			//$redirect = Session::get('loginRedirect', 'account');

			// Unset the page we were before from the session
			//Session::forget('loginRedirect');

            //check if you approve the policy
            if(!$user->approved){
                return Redirect::route('userApprove');
            }

			// Redirect to the users page
			return Redirect::route('signin')->with('success', Lang::get('auth/message.signin.success'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		}

		// Ooops.. something went wrong
		return Redirect::route('signin')->withInput()->withErrors($this->messageBag);
	}

	/**
	 * Account sign up.
	 *
	 * @return View
	 */
	public function getSignup()
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

        $countries = DB::table('countries')->lists('name','id');

        $groups = Sentry::getGroupProvider()->createModel()->where('id','!=', 1)->lists('name', 'id');

        //Debugbar::info($groups);

		// Show the page
		return View::make('frontend.auth.signup')
                    ->with('countries',$countries)
                    ->with('groups', $groups);
	}

	/**
	 * User account activation page.
	 *
	 * @param string  $activationCode
	 * @return
	 */
	public function getActivate($activationCode = null)
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

		try
		{
			// Get the user we are trying to activate
			$user = Sentry::getUserProvider()->findByActivationCode($activationCode);

			// Try to activate this user account
			if ($user->attemptActivation($activationCode))
			{
				// Redirect to the login page
				return Redirect::route('signin')->with('success', Lang::get('auth/message.activate.success'));
			}

			// The activation failed.
			$error = Lang::get('auth/message.activate.error');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$error = Lang::get('auth/message.activate.error');
		}

		// Ooops.. something went wrong
		return Redirect::route('signin')->with('error', $error);
	}

	/**
	 * Forgot password page.
	 *
	 * @return View
	 */
	public function getForgotPassword()
	{
		// Show the page
		return View::make('frontend.auth.forgot-password');
	}

	/**
	 * Forgot password form processing page.
	 *
	 * @return Redirect
	 */
	public function postForgotPassword()
	{
		// Declare the rules for the validator
		$rules = array(
			'email' => 'required|email',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::route('forgot-password')->withInput()->withErrors($validator);
		}

		try
		{
			// Get the user password recovery code
			$user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

			// Data to be used on the email view
			$data = array(
				'user'              => $user,
				'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
			);

			// Send the activation code through email
			Mail::send('emails.forgot-password', $data, function($m) use ($user)
			{
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Account Password Recovery');
			});
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Even though the email was not found, we will pretend
			// we have sent the password reset code through email,
			// this is a security measure against hackers.
		}

		//  Redirect to the forgot password
		return Redirect::route('forgot-password')->with('success', Lang::get('auth/message.forgot-password.success'));
	}

	/**
	 * Forgot Password Confirmation page.
	 *
	 * @param  string  $passwordResetCode
	 * @return View
	 */
	public function getForgotPasswordConfirm($passwordResetCode = null)
	{
		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
		}
		catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}

		// Show the page
		return View::make('frontend.auth.forgot-password-confirm');
	}

	/**
	 * Forgot Password Confirmation form processing page.
	 *
	 * @param  string  $passwordResetCode
	 * @return Redirect
	 */
	public function postForgotPasswordConfirm($passwordResetCode = null)
	{
		// Declare the rules for the form validation
		$rules = array(
			'password'         => 'required',
			'password_confirm' => 'required|same:password'
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
		}

		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

			// Attempt to reset the user password
			if ($user->attemptResetPassword($passwordResetCode, Input::get('password')))
			{
				// Password successfully reseted
				return Redirect::route('signin')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
			}
			else
			{
				// Ooops.. something went wrong
				return Redirect::route('signin')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}
	}

	/**
	 * Logout page.
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		// Log the user out
		Sentry::logout();

		// Redirect to the users page
		return Redirect::route('home')->with('flash_error', 'Good Bye !');
	}

}
