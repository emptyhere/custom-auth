<?php

use Illuminate\Http\Request;
use App\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get()

Route::resource('registr', 'Auth\RegisterController');
Route::resource('login', 'Auth\LoginController');
//Route::post('logout', 'Auth\LoginController@logout');

Route::prefix('admin')->group(function() {
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController')->middleware('auth:api');
});
