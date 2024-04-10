<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;

class ProfileController extends AuthorizedController {

	/**
	 * User profile page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get the user information
		$user = \User::with('data')->with('dependents')->with('pets')->with('cars')->find(Sentry::getUser()->getId());

		// Show the page
		return View::make('frontend/account/profile', compact('user'));
	}

	/**
	 * User profile form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'first_name' => 'required|min:3'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Grab the user
        $user = \User::find(Sentry::getUser()->getId());

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

        /**
         * get user info
         */
        $put_user = array(
            'first_name'  => Input::get( 'first_name' )
        );

        $user->update($put_user);


		// Redirect to the settings page
		return Redirect::route('profile')->with('success', 'Account successfully updated');
	}

}
