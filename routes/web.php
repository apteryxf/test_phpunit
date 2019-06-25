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
Auth::routes(['verify' => true]);
Route::post('login', 'Auth\LoginController@authenticate');
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'verified'], function(){
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/members', 'MemberController@index')->name('members.index');
    Route::get('/vue_table', 'MemberController@vue');
});
