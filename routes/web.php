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
Route::get('/my-jobs','HomeController@my_posted')->middleware('user_logout');
Route::match(['get','post'],'/edit-post-job/{id}','HomeController@edit_job_posted')->middleware('user_logout');
Route::match(['get','post'],'/edit-profile','HomeController@edit_profile')->middleware('user_logout');

Route::post('/exist-mail','HomeController@exist_mail');
Route::post('/exist-mobile','HomeController@exist_mobile');
Route::post('/exist-mobile-number','HomeController@exist_mobile_number');
Route::post('/get-file','HomeController@job_attachment');
Route::post('/delete-attachment','HomeController@delete_attachment')->middleware('user_logout');;
Route::get('/my-profile','UserController@my_profile')->middleware('user_logout');;
Route::post('/prof-description-secend-block','UserController@prof_description_secend_block')->middleware('user_logout');;

Route::post('/prof-description-first-block','UserController@prof_description_first_block')->middleware('user_logout');;
Route::get('/prof-description-third-block','UserController@prof_description_third_block')->middleware('user_logout');;
Route::post('/prof-description-portpolio-block','UserController@prof_description_portpolio_block')->middleware('user_logout');;
Route::post('/prof-description-logo-block','UserController@prof_description_logo_block')->middleware('user_logout');;
Route::post('/prof-pic-upload','UserController@prof_pic_upload')->middleware('user_logout');;
Route::get('/get-details','UserController@get_details');
Route::get('/profile/{prof_slug}','UserController@view_tradesman_profile');
Route::post('/invited-builder-list','UserController@invited_builder_list')->middleware('user_logout');
Route::post('/builder-proposal-list','UserController@builder_proposal_list')->middleware('user_logout');
Route::post('/hire-builder','UserController@hire_builder')->middleware('user_logout');
Route::get('/jobs-given','HomeController@jobs_given')->middleware('user_logout');
Route::post('/review-post','HomeController@review_post')->middleware('user_logout');
Route::get('/delete-job/{id}','HomeController@delete_job')->middleware('user_logout');
Route::post('/invited-builder','UserController@invited_builder')->middleware('user_logout');
Route::get('/my-invited','UserController@my_invited')->middleware('user_logout');
Route::post('/provider-quote-submit','UserController@provider_quote_submit')->middleware('user_logout');
Route::match(['get','post'],'/my-awarded-job','UserController@awarded_provider_job')->middleware('user_logout');
Route::post('/provider-quote-submit','UserController@provider_quote_submit')->middleware('user_logout');
Route::post('/provider-mark-complete-job','UserController@provider_mark_complete_job')->middleware('user_logout');

/*Admin*/
Route::get('/admin',function(){	return view('admin.admin_login');});
Route::post('admin-login','admin\HomeController@login');
Route::get('admin-logout','admin\HomeController@logout');
Route::get('/admin-dashboard','admin\HomeController@dashboard');
Route::match(['post','get'],'/admin-change-password','admin\HomeController@change_password')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-customers-list','admin\UserController@customers_list')->middleware('admin_login');
Route::get('/admin-customer-status/{id}','admin\UserController@customer_status')->middleware('admin_login');
Route::get('/admin-customer-details/{id}','admin\UserController@customer_details')->middleware('admin_login');
Route::get('/admin-customer-approve/{id}','admin\UserController@customer_approve')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-tradesmen-list','admin\UserController@tradesmen_list')->middleware('admin_login');
Route::get('/admin-tradesmen-status/{id}','admin\UserController@tradesmen_status')->middleware('admin_login');
Route::get('/admin-tradesmen-details/{id}','admin\UserController@tradesmen_details')->middleware('admin_login');
Route::get('/admin-tradesmen-delete/{id}','admin\UserController@tradesmen_delete')->middleware('admin_login');
Route::get('/admin-tradesmen-approve/{id}','admin\UserController@tradesmen_approve')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-package-list','admin\UserController@package_list')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-edit-package/{id}','admin\UserController@edit_package')->middleware('admin_login');
Route::get('/admin-package-status/{id}','admin\UserController@package_status')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-category-list','admin\CategoryController@index')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-add-category','admin\CategoryController@add_category')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-edit-category/{id}','admin\CategoryController@edit_category')->middleware('admin_login');
Route::get('/admin-category-status/{id}','admin\CategoryController@category_status')->middleware('admin_login');
Route::get('/admin-category-delete/{id}','admin\CategoryController@delete_category')->middleware('admin_login');

//job
Route::match(['get', 'post'],'admin-posted-job-list','admin\JobController@posted_job_list')->middleware('admin_login');
Route::get('/admin-posted-job-status/{id}','admin\JobController@change_job_status')->middleware('admin_login');
Route::get('/admin-view-job-details/{id}','admin\JobController@view_job_details')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-change-credential','admin\UserController@change_credential')->middleware('admin_login');
/*Admin*/
