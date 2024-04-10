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

use DB;
use Input;
use Redirect;
use ScubaClick\Pages\Models\Category;
use View;
use Debugbar;


class DeptController extends CpanelController {

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

        if(!\Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        // User is logged in
        $data['depts'] = Category::all();

        $this->layout->content = View::make('admin.dept.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(!\Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        // User is logged in
        $data['depts'] = Category::all();

        $this->layout->content = View::make('admin.dept.create', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $dept = Category::create(array(
                                      'id'  => null,
                                      'title'  => Input::get('title'),
                                      'slug' => Input::get('slug'),
                                      'parent'  => Input::get('parent')
                                 ));

        //if not created otherwise is exists
        if(!$dept->exists){
             return Redirect::back()->with('flash_error', 'the department slug was exists');
        }else{
            //so save it plz :P
            $dept->save();
            return Redirect::back()->with('flash_error', 'the department was added successfully');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(!\Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        $data['id'] = $id;

        $data['dept'] = Category::find($id);

        $data['depts'] = Category::orderBy('id', 'asc')->lists('title','id');

        $data['depts'][0] = 'No Parent (ROOT)';

        $this->layout->content = View::make('admin.dept.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $dept = Category::find($id);

        $dept->title = Input::get('title');
        $dept->slug = Input::get('slug');
        $dept->parent = Input::get('parent');

        $dept->save();

        return Redirect::back()->with('flash_error', 'the Department was updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(!\Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        Category::find($id)->delete();
        return Redirect::back()->with('flash_error', 'the Department was deleted successfully');
	}

}