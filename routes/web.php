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

Route::get('/', 'PagesController@index')->name('homepage');
Route::get('/login', 'PagesController@login')->name('login');
Route::post('/auth/process', 'UserController@processlogin')->name('process_login');
Route::get('/logout', 'UserController@logout')->name('logout');


Route::group(['middleware'=>'auth'], function(){

	Route::get('/dashboard', 'PagesController@dashboard');
	//Route::get('/user/check', 'PayController@checkPaymentStatus');

	//when the user is logged in... 


});



Route::get('/tb/migrate/{model}', function($model){
	$model = '\App\\'.studly_case($model);
	$model::migrate();
});
