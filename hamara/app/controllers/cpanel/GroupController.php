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

namespace Controllers\Cpanel;

use CpanelController;

use Input;
use Redirect;
use Sentry;
use Validator;
use View;
use Debugbar;
use Session;
use Cartalyst\Sentry\Groups;

class GroupController extends CpanelController {

	/**
	 * Constructor
	 */
	public function __construct() 
	{
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

		// Index - show the user's group details.
		try
		{
		    // Find the current user
		    if ( ! Sentry::check())
			{
			    // User is not logged in, or is not activated
			    Session::flash('error', 'You must be logged in to perform that action.');
				return Redirect::to('/');
			}
			else
			{
			    // User is logged in
			    $user = Sentry::getUser();

			    // Get the user groups
			    $data['myGroups'] = $user->getGroups();

			    //Get all the available groups.
			    $data['allGroups'] = Sentry::getGroupProvider()->findAll();


                $this->layout->content = View::make('admin.groups.index', $data);
			}
		    
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Session::flash('error', 'User was not found.');
			return Redirect::to('groups/');
		}
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');
		//Form for creating a new Group
        $this->layout->content = View::make('admin.groups.create');
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Store the new group in the db.
		//Start with Data Validation
		// Gather Sanitized Input
		$input = array(
			'newGroup' => Input::get('newGroup')
			);

		// Set Validation Rules
		$rules = array (
			'newGroup' => 'required|min:4'
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
            return Redirect::back()->withErrors($v)->withInput();
		}
		else
		{
			try
			{
			    // Create the group
			    $group = Sentry::createGroup(array(

					'name' => $input['newGroup'],
				        'permissions' => array(
				            'admin' => Input::get('adminPermissions', 0),
				            'users' => Input::get('userPermissions', 0),
				        ),
				    ));


                if ($group->save()) {
                    return Redirect::back()->with('flash_error', 'New Group Created successfully');
				} else {
                    return Redirect::back()->with('flash_error', 'New Group not created');
				}
			}
			catch (Groups\NameRequiredException $e)
			{
                return Redirect::back()->with('flash_error', 'Name field is required')->withErrors($v)->withInput();
			}
            catch (Groups\GroupExistsException $e)
            {
                return Redirect::back()->with('flash_error', 'Group already exists')->withErrors($v)->withInput();
            }
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

		//Show a group and its permissions. 
		try
		{
		    // Find the group using the group id
		    $data['group'] = Sentry::getGroupProvider()->findById($id);

		    // Get the group permissions
		    $data['groupPermissions'] = $data['group']->getPermissions();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    Session::flash('error', 'Group does not exist.');
			return Redirect::to('groups');
		}


        $this->layout->content = View::make('admin.groups.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');
		//Pull the selected group
		try
		{
		    // Find the group using the group id
		    $data['group'] = Sentry::getGroupProvider()->findById($id);

		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    Session::flash('error', 'Group does not exist.');
			return Redirect::to('groups');
		}

        $this->layout->content = View::make('admin.groups.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		// Update the Group.
		// Start with Data Validation
		// Gather Sanitized Input

        //Debugbar::info(Input::except('_method','_token','name'));
        //$permssions = Input::except('_method','_token','name');

		$input = array(
			'name' => Input::get('name')
			);

		// Set Validation Rules
		$rules = array (
			'name' => 'required|min:4'
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('groups/'. $id . '/edit')->withErrors($v)->withInput();
		}
		else
		{

			try
			{
			    // Find the group using the group id
			    $group = Sentry::getGroupProvider()->findById($id);
                //Input::except('_method','_token','name');
			    // Update the group details
			    $group->name = $input['name'];
			    $group->permissions = array(
			       'property.add' => Input::get('property.add'),
                   'property.edit' => Input::get('property.edit'),
                   'property.view' => Input::get('property.view'),
                   'property.delete' => Input::get('property.delete')
			    );

			    // Update the group
			    if ($group->save())
			    {
			        // Group information was updated
			        Session::flash('success', 'Group has been updated.');
					return Redirect::to('admin/groups');
			    }
			    else
			    {
			        // Group information was not updated
			        Session::flash('error', 'There was a problem updating the group.');
					return Redirect::to('admin/groups/'. $id . '/edit')->withErrors($v)->withInput();
			    }
			}
			catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
			{
			    Session::flash('error', 'Group already exists.');
				return Redirect::to('admin/groups/'. $id . '/edit')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    Session::flash('error', 'Group was not found.');
				return Redirect::to('admin/groups/'. $id . '/edit')->withErrors($v)->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{

        if(!Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

		try
		{
		    // Find the group using the group id
		    $group = Sentry::getGroupProvider()->findById($id);

		    // Delete the group
		    if ($group->delete())
		    {
		        // Group was successfully deleted
		        Session::flash('success', 'Group has been deleted.');
				return Redirect::to('groups/');
		    }
		    else
		    {
		        // There was a problem deleting the group
		        Session::flash('error', 'There was a problem deleting that group.');
				return Redirect::to('groups/');
		    }
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    Session::flash('error', 'Group was not found.');
			return Redirect::to('groups/');
		}
	}

}