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

// Route::get('/awal', function () {
//     return view('home');
// });

Route::get('/', 'SiteController@home');
Route::get('/about', 'SiteController@about');
Route::post('/site/siswa/register', 'SiteController@register');

Route::get('/siswa/register', function () {
    return view('register');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth', 'checkRole:master']], function () {
    Route::get('/admins', 'AdminController@index');
    Route::post('/admins/create', 'AdminController@create');
    Route::get('/admins/{id}/delete', 'AdminController@delete');
    Route::get('/admins/{id}/edit', 'AdminController@edit');
    Route::post('/admins/{idadmin}/{iduser}/update', 'AdminController@update');
    Route::get('/admins/{id}/rubahpassword', 'AdminController@rubahpassword');
    Route::post('/admins/{id}/updatepassword', 'AdminController@updatepassword');
});

Route::group(['middleware' => ['auth', 'checkRole:master,admin']], function () {
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{id}/profile', 'SiswaController@profile');
    Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{id}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/siswa/exportExcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportpdf', 'SiswaController@exportPdf');
    Route::post('/siswa/import', 'SiswaController@importexcel')->name('siswa.import');
    Route::get('/guru/{id}/profile', 'GuruController@profile');
    Route::get('/guru', 'GuruController@index');
    Route::post('/guru/create', 'GuruController@create');
    Route::get('/siswa/{id}/rubahpassword', 'SiswaController@rubahpassword');
    Route::post('/siswa/{id}/updatepassword', 'SiswaController@updatepassword');
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('post/add', [
        'uses' => 'PostController@add',
        'as' => 'posts.add',
    ]);
    Route::post('post/create', [
        'uses' => 'PostController@create',
        'as' => 'posts.create',
    ]);

    Route::get('getdataguru', [
        'uses' => 'GuruController@getdataguru',
        'as' => 'ajax.get.data.guru',

    ]);
});

Route::group(['middleware' => ['auth', 'checkRole:master,admin,siswa,guru']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    Route::post('/siswa/{idsiswa}/{iduser}/update', 'SiswaController@update');
    Route::get('/siswa/{id}/profile', 'SiswaController@profile');
});



Route::get('getdatasiswa', [
    'uses' => 'SiswaController@getdatasiswa',
    'as' => 'ajax.get.data.siswa',

]);

// tempatkan route ini harus paling bawah dari route yang lainnya
Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as' => 'site.single.post'

]);
