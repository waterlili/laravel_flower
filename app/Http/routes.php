<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Blade::setContentTags('<%', '%>');        // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');   // for escaped data


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
  Route::controller('auth', 'Auth\AuthController');

// Password reset link request routes...
  Route::get('password/email', 'Auth\PasswordController@getEmail');
  Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
  Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
  Route::post('password/reset', 'Auth\PasswordController@postReset');
  Route::get('password/set/{token}', 'Auth\PasswordController@getPass');

  Route::get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha')
    ->middleware('web');

  Route::controller('/console/customer', 'Adm\CustomerController');
  Route::controller('/console/manage', 'Adm\ManageController');
  Route::controller('/console/product', 'Adm\ProductController');
  Route::controller('/console/order', 'Adm\OrderController');
  Route::controller('/console/cost', 'Adm\CostController');
  Route::controller('/console/profile', 'Adm\ProfileController');
  Route::controller('/console', 'Adm\AdminController');
  Route::controller('/', 'PublicController');
});
