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
//Route::get('/ajaxList', 'Controller1@ajaxList')->name('ajaxList'); for second ajax
Route::get('watchNews/{id}', 'Controller1@watchNews')->name('watchIt');
Route::get('add/','Controller1@showAdd')->name('showAddList');

Route::get('/notExist', 'Controller@ret')->name('ret');

Route::post('/add','Controller1@store')->name('add');
Route::post('/ajaxList/{idd}', 'Controller1@storePicture');
Route::post('/editList', 'Controller1@editChange')->name('editChange');
Route::post('/ajaxListEdit/{idd}', 'Controller1@editPicture');
Route::get('/changeName/{name}' , 'Controller1@changeName');
Route::get('ajaxtest/','Controller1@viewajax')->name('ajaxview');  // try
Route::post('/getmsg','Controller1@index');//try
//Route::post('/register', 'Controller1@register')->name('register');
//// Route::post('/register','Controller1@store')->name('addtest');
Route::get('edit/{id}', 'Controller1@edit')->name('editList');

Route::get('/{id}', 'Controller1@delete')->name('deleteList');





