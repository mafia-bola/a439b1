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
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard','DashboardController@index')->name('admin.dashboard.index');
    Route::get('profile','UserController@profile')->name('admin.user.profile');
    Route::post('profile','UserController@updateProfile')->name('admin.user.profile.update');
    Route::resources([
        'user' => 'UserController',
        'bidang' => 'BidangController',
        'jabatan' => 'JabatanController',
        'kode-surat' => 'KodeSuratController',
        'posisi' => 'PosisiController',
        'alur' => 'AlurController',
        'alur-posisi' => 'AlurPosisiController'
    ]);

    Route::get('surat','SuratController@index')->name('surat.index');
    Route::get('surat/create','SuratController@create')->name('surat.create');
    Route::get('surat/{id}/edit','SuratController@edit')->name('surat.edit');
    Route::get('surat/{id}','SuratController@show')->name('surat.show');
    Route::delete('surat/{id}', 'SuratController@destroy')->name('surat.destroy');
    Route::post('surat','SuratController@store')->name('surat.store');
});
