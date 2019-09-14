<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/createpost', function () {
    return view('createpost');
});

Route::get('/reg', function () {
    return view('registr');
});

Route::get('/updateuser', function () {
    return view('updateuser');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/createuser', function () {
    return view('createuser');
})->name('createuser');

