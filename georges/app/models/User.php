<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = false;

    public function data()
    {
        return $this->hasOne('UserData', 'user_id');
    }

    public function dependents()
    {
        return $this->hasMany('UserDep', 'user_id');
    }

    public function pets()
    {
        return $this->hasOne('UserPets', 'user_id');
    }

    public function cars()
    {
        return $this->hasOne('UserCars', 'user_id');
    }

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullName()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function gravatar()
	{
		// Generate the Gravatar hash
		$gravatar = md5(strtolower(trim($this->gravatar)));

		// Return the Gravatar url
		return "//gravatar.org/avatar/{$gravatar}";
	}

}
