<?php
Route::get('/','HomeController@index');
Route::post('/post-job','HomeController@post_job');
Route::match(['post','get'],'/signup','HomeController@signup');
Route::match(['post','get'],'/verification','HomeController@verification');
Route::match(['post','get'],'/login','HomeController@login');
Route::get('/dashboard','HomeController@dashboard');
Route::post('/exist-mail','HomeController@exist_mail');
