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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/domain', 'Admin\DomainController');
Route::get('/domain-edit/{id}', 'Admin\DomainController@edit');
Route::put('/domain-edit/{id}', 'Admin\DomainController@store');
Route::put('domain-edit/{id}', 'Admin\DomainController@update');
Route::delete('/domain-edit/{id}', 'Admin\DomainController@destroy');

