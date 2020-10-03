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
    return view('home');
});

Route::get('/siswa/register', function () {
    return view('register');
});
Route::post('/site/siswa/register', 'SiteController@register');


Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth', 'checkRole:master']], function () {
    Route::get('/admins', 'AdminController@index');
    Route::post('/admins/create', 'AdminController@create');
});

Route::group(['middleware' => ['auth', 'checkRole:master,admin']], function () {
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    Route::post('/siswa/{id}/update', 'SiswaController@update');
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{id}/profile', 'SiswaController@profile');
    Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{id}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/guru/{id}/profile', 'GuruController@profile');
});

Route::group(['middleware' => ['auth', 'checkRole:master,admin,siswa']], function () {
    Route::get('/dashboard', 'DashboardController@index');
});
