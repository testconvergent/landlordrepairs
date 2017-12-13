<?php
Route::get('/','HomeController@index');
Route::post('/post-job','HomeController@post_job');
Route::match(['post','get'],'/signup','HomeController@signup')->middleware('user_login');
Route::match(['post','get'],'/verification','HomeController@verification')->middleware('user_login');
Route::get('/verifiy/{key}','HomeController@verifiy')->middleware('user_login');
Route::match(['post','get'],'/identity-verification','HomeController@identity_verification')->middleware('user_login')->middleware('user_login');
Route::match(['post','get'],'/payment','HomeController@payment')->middleware('user_login')->middleware('user_login');
Route::match(['post','get'],'/tradesmen-package','HomeController@tradesmen_package')->middleware('user_login')->middleware('user_login');
Route::match(['post','get'],'/forget-password','HomeController@forget_password')->middleware('user_login')->middleware('user_login');
Route::match(['post','get'],'/login','HomeController@login')->middleware('user_login');
Route::match(['post','get'],'/tradesmen','HomeController@tradesmen');
Route::match(['post','get'],'/tradesmen-signup','HomeController@tradesmen_signup')->middleware('user_login');
Route::get('/logout','HomeController@logout');
Route::get('/my-posted','HomeController@my_posted')->middleware('user_logout');
Route::match(['get','post'],'/edit-post-job/{id}','HomeController@edit_job_posted')->middleware('user_logout');
Route::post('/exist-mail','HomeController@exist_mail');
Route::post('/exist-mobile','HomeController@exist_mobile');
Route::get('/my-profile','UserController@my_profile');
Route::post('/prof-description-secend-block','UserController@prof_description_secend_block');
Route::get('/prof-description-third-block','UserController@prof_description_third_block');
Route::post('/prof-description-portpolio-block','UserController@prof_description_portpolio_block');
Route::post('/prof-description-logo-block','UserController@prof_description_logo_block');
Route::post('/prof-pic-upload','UserController@prof_pic_upload');

/*Admin*/
Route::get('/admin',function(){	return view('admin.admin_login');});
Route::post('admin-login','admin\HomeController@login');
Route::get('admin-logout','admin\HomeController@logout');
Route::get('/admin-dashboard','admin\HomeController@dashboard');
Route::match(['post','get'],'/admin-change-password','admin\HomeController@change_password')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-customers-list','admin\UserController@customers_list')->middleware('admin_login');
Route::get('/admin-customer-status/{id}','admin\UserController@customer_status')->middleware('admin_login');
Route::get('/admin-customer-details/{id}','admin\UserController@customer_details')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-tradesmen-list','admin\UserController@tradesmen_list')->middleware('admin_login');
Route::get('/admin-tradesmen-status/{id}','admin\UserController@tradesmen_status')->middleware('admin_login');
Route::get('/admin-tradesmen-details/{id}','admin\UserController@tradesmen_details')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-package-list','admin\UserController@package_list')->middleware('admin_login');
/*Admin*/
