<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * Everything to do with The about View
 */
Route::get('About', [
    'middleware' => 'auth',
    'uses' => 'RequestController@GetHistory'
]);



Route::get('AboutHistory',  array(
    'middleware' => 'auth',
    'uses' => 'RequestController@GetHistoryFull',
));

Route::get('test', 'RequestController@Test');

/*
 * Everything about AUTH views ND redirects
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



