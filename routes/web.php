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
Route::get('kyc/{user}', 'ActionController@kyc')->name('kyc');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('accept', 'contract')->name('accept');

Route::get('actions', 'ActionController@index')->name('actions');
Route::get('match/{lending}', 'ActionController@match')->name('matches');

Route::get('lend', 'ActionController@lend')->name('actions.lend');

Route::post('lend', 'ActionController@createLend')->name('actions.lend.create');

Route::get('borrow', 'ActionController@borrow')->name('borrow');
Route::post('borrow', 'ActionController@createBorrow')->name('borrow.create');

Route::get('consent', 'BOCAuthorization@showConsent')->name('consent');
Route::get('authorize', 'BOCAuthorization@callback')->name('consent.callback');
