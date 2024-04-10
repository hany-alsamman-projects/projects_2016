<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'admin'), function()
{
    Route::get('signout', array('as' => 'signout', function () {

        Sentry::logout();
        //Session::flush();
        return Redirect::route('login')->with('flash_error', 'Logged out Successfully!');

    }))->before('auth');

    Route::get('login', array('as' => 'login', function () {
        return View::make('admin.login');
    }))->before('guest');

    Route::post('login', array('uses' => 'CpanelController@postLogin'));

});

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    Route::resource('dept', 'Controllers\Cpanel\DeptController');
    Route::post('dept/{id}/update', array('uses' => 'Controllers\Cpanel\DeptController@update'))->where(array('id' => '[0-9]+'));
    Route::get('dept/{id}/delete', array('uses' => 'Controllers\Cpanel\DeptController@destroy'))->where(array('id' => '[0-9]+'));

    Route::resource('page', 'Controllers\Cpanel\PageController');
    Route::post('page/{id}/update', array('uses' => 'Controllers\Cpanel\PageController@update'))->where(array('id' => '[0-9]+'));
    Route::get('page/{id}/delete', array('uses' => 'Controllers\Cpanel\PageController@destroy'))->where(array('id' => '[0-9]+'));

    Route::resource('groups', 'Controllers\Cpanel\GroupController');

    # User Management
    Route::get('users/{user}/show', 'Controllers\Cpanel\UsersController@getShow');
    Route::get('users/{user}/edit', 'Controllers\Cpanel\UsersController@getEdit');
    Route::post('users/{user}/edit', 'Controllers\Cpanel\UsersController@postEdit');
    Route::get('users/{user}/delete', 'Controllers\Cpanel\UsersController@getDelete');
    Route::post('users/{user}/delete', 'Controllers\Cpanel\UsersController@postDelete');
    Route::controller('users', 'Controllers\Cpanel\UsersController');


    Route::resource('slides', 'Controllers\Cpanel\SlidesController');
    Route::get('slides/{id}/delete', array('uses' => 'Controllers\Cpanel\SlidesController@destroy'))->where(array('id' => '[0-9]+'));
    Route::post('slides/{id}/edit', 'Controllers\Cpanel\SlidesController@update')->where(array('id' => '[0-9]+'));


    # Admin Dashboard
    Route::get('/', array('as' => 'dashboard', 'uses' => 'CpanelController@getDashboard'));

});

Route::get('portfolio', array('as' => 'portfolio', 'uses' => 'HomeController@getPortfolio'));


Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

Route::group(array('before' => 'auth'), function()
{
    \Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    \Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
});

\Route::get('elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');


###############

Route::get('page/{slug?}', 'HomeController@getPage');

Route::post('{search?}', array('as' => 'search', 'uses' =>  'HomeController@getSearch') );


Route::get('{any?}', array('as' => 'hany', 'uses' => 'HomeController@getIndex', function ($any) {

}))->where (
        array(
            'any' =>'index.php|index.html|index'
        ));

Route::post('page/contact-us', array('as' => 'contactus', 'uses' =>  'HomeController@postContact') );