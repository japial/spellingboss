<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
//API Routes
Route::prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/manage-users', 'UserController@manageUsers')->name('manage.users');
    Route::get('/manage-words', 'WordController@index')->name('manage.words');
    Route::get('/spellit-words', 'WordController@spellitWords')->name('spellit.words');
    Route::resource('users', 'UserController', [
        'except' => ['show', 'create']
    ]);
    Route::resource('spellits', 'SpellitController', [
        'except' => ['show', 'create']
    ]);
});