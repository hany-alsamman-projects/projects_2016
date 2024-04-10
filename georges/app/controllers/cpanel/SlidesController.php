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
use View;
use Debugbar;
use Slides;


class SlidesController extends CpanelController {

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
        $data['slides'] = Slides::all();

        $this->layout->content = View::make('admin.slides.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(!\Sentry::getUser()->isSuperUser() ) return \Response::view('error.permissions');

        $this->layout->content = View::make('admin.slides.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $avatar_name = false;

        if(Input::hasFile('upload_photo')){

            $extension = Input::file('upload_photo')->getClientOriginalExtension();
            $avatar_name = uniqid() . '.' . $extension;

            $dest = base_path() .'/' . 'upload/slides';

            Input::file('upload_photo')->move($dest,$avatar_name);

            @chmod($dest.'/'.$avatar_name,0777);
        }

        $slide = Slides::create(array(
            'id'  => null,
            'title'  => Input::get('title'),
            'description' => Input::get('description'),
            'position'  => Input::get('position'),
            'img_id'  =>  (Input::hasFile('upload_photo')) ? $avatar_name : false
        ));

        //so save it plz :P
        $slide->save();
        return Redirect::back()->with('flash_error', 'the slide is added successfully');
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

        $data['slide'] = Slides::find($id);

        $this->layout->content = View::make('admin.slides.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $dept = Slides::find($id);

        if(Input::hasFile('upload_photo')){

            $extension = Input::file('upload_photo')->getClientOriginalExtension();
            $avatar_name = uniqid() . '.' . $extension;

            $dest = base_path() .'/' . 'upload/slides';

            Input::file('upload_photo')->move($dest,$avatar_name);

            @chmod($dest.'/'.$avatar_name,0777);
        }

        $dept->title = Input::get('title');
        $dept->description = Input::get('description');
        $dept->position = Input::get('position');
        $dept->img_id = (Input::hasFile('upload_photo')) ? $avatar_name : false;

        $dept->save();

        return Redirect::back()->with('flash_error', 'the slide is updated successfully');
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

        Slides::find($id)->delete();
        return Redirect::back()->with('flash_error', 'the Slide was deleted successfully');
	}

}