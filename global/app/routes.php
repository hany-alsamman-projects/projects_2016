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
        return Redirect::route('login')->with('flash_error', 'لقد تم تسجيل الخروح بنجاح');

    }))->before('auth');

    Route::get('login', array('as' => 'login', function () {
        return View::make('admin.login');
    }))->before('guest');

    Route::post('login', array('uses' => 'CpanelController@postLogin'));

});

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    Route::group(array('prefix' => 'product'), function()
    {

        Route::get('/', array('as' => 'ShowProducts','uses' => 'Controllers\Cpanel\ProductController@getIndex'));

        Route::get('product-by-dept/{id}', array('uses' => 'Controllers\Cpanel\ProductController@getProductsByDEPT'))->where(array('id' => '[0-9]+'));

        Route::get('add', array('uses' => 'Controllers\Cpanel\ProductController@getAddProduct'));

        Route::post('add', array('as' => 'AddProduct', 'uses' => 'Controllers\Cpanel\ProductController@postAddProduct'));

        Route::get('import', array('as' => 'ImportProducts', 'uses' => 'Controllers\Cpanel\ProductController@getImportProducts'));
        Route::post('import', array('as' => 'ImportProcess', 'uses' => 'Controllers\Cpanel\ProductController@postImportProducts'));

        Route::get('edit/{id}', array('uses' => 'Controllers\Cpanel\ProductController@getEditProduct'))->where(array('id' => '[0-9]+'));

        Route::post('edit/{id}', array('uses' => 'Controllers\Cpanel\ProductController@postEditProduct'))->where(array('id' => '[0-9]+'));

        Route::get('delete/{id}', array('uses' => 'Controllers\Cpanel\ProductController@DeleteProduct'))->where(array('id' => '[0-9]+'));

    });

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

    # Admin Dashboard
    Route::get('/', array('as' => 'dashboard', 'uses' => 'CpanelController@getDashboard'));

});

#Route::get('/page/{slug}', 'HomeController@getPage');

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));



/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------


Route::group(array('prefix' => 'auth'), function()
{


    Route::get('/', array('uses' => 'AuthController@getSignin'))->before('guest');

    # Login
    Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
    Route::post('signin', 'AuthController@postSignin');

    # FB Register
    Route::get('fb/signup', 'SocialController@getFBsignup');

    # Register
    Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
    Route::post('signup', 'AuthController@postSignup');

    # Account Activation
    Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

    # Forgot Password
    Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
    Route::post('forgot-password', 'AuthController@postForgotPassword');

    # Forgot Password Confirmation
    Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

    # Logout
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});

*/

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------


Route::group(array('prefix' => 'account'), function()
{

    # Account Dashboard
    Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));

    # Profile
    Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
    Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

    # Change Password
    Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
    Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

    # Change Email
    Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
    Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

});

*/
Route::group(array('before' => 'auth'), function()
{
    \Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    \Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
});

\Route::get('elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');


###############



Route::get('{lang?}/page/{slug?}', 'HomeController@getPage')->where (
    array(
        'lang' =>'ar|en'));

Route::post('{lang?}/{search?}', array('as' => 'search', 'uses' =>  'HomeController@getSearch') )->where (
    array(
        'lang' =>'ar|en'));


Route::get('{lang?}/{any?}', array('as' => 'hany', 'uses' => 'HomeController@getIndex', function ($lang , $any) {

}))->where (
        array(
            'lang' =>'ar|en',
            'any' =>'index.php|index.html|index'
        ));

Route::post('en/page/contact-us', array('as' => 'contactus', 'uses' =>  'HomeController@postContact') )->where (
    array(
        'lang' =>'ar|en'));

################

Route::group(array('prefix' => '{lang?}/products'), function()
{

    //Route::get('/', array('as' => 'ShowProducts','uses' => 'iProductController@getIndex'));

    Route::get('/{slug}', array('uses' => 'iProductController@getProductsByDEPT'));

    Route::get('/view/{id}', array('uses' => 'iProductController@ViewProduct'))->where(array('id' => '[0-9]+'));;

});