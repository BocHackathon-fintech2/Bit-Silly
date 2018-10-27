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

Route::get('/', function() {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('actions', 'ActionController@index')->name('actions');

Route::get('lend', 'ActionController@lend')->name('actions.lend');
Route::post('lend', 'ActionController@createLend')->name('actions.lend.create');

Route::get('borrow', 'ActionController@borrow')->name('actions.borrow');
Route::get('borrow', 'ActionController@createBorrow')->name('actions.borrow.create');
