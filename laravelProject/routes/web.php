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

Route::get('/', 'Controller1@someName')->name('list');
Route::get('watchNews/{id}', 'Controller1@watchNews')->name('watchIt');
Route::get('add/','Controller1@showAdd')->name('showAddList');
Route::post('add/','Controller1@store')->name('add');
Route::get('edit/{id}', 'Controller1@edit')->name('editList');
Route::post('edit/{id}', 'Controller1@editChange')->name('editChange');
Route::get('/{id}', 'Controller1@delete')->name('deleteList');




