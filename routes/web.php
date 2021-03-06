<?php
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
Route::get('/','HomeController@index');
Route::post('/post-job','HomeController@post_job');
Route::match(['post','get'],'/signup','HomeController@signup')->middleware('user_login');
Route::match(['post','get'],'/verification','HomeController@verification')->middleware('user_login');
Route::get('/verifiy/{key}','HomeController@verifiy')->middleware('user_login');
Route::match(['post','get'],'/identity-verification','TradesmanSignUpController@identity_verification')->middleware('user_login')->middleware('user_login');
Route::match(['post','get'], '/payment', 'TradesmanSignUpController@payment')->name('payment');
Route::match(['post','get'],'/tradesmen-package','HomeController@tradesmen_package')->middleware('user_login');
Route::match(['post','get'],'/forget-password','LoginController@forget_password')->middleware('user_login');
Route::get('/reset-password/{id}','LoginController@reset_password');
Route::post('/submit-reset-password','LoginController@submit_reset_password');
Route::match(['post','get'],'/login','HomeController@login')->middleware('user_login');
Route::match(['post','get'],'/tradesmen','HomeController@tradesmen');
Route::match(['post','get'],'/tradesmen-signup','TradesmanSignUpController@tradesmen_signup')->middleware('user_login');
Route::get('/logout','HomeController@logout');
Route::get('/my-jobs','HomeController@my_posted')->middleware('user_logout');
Route::match(['get','post'],'/edit-post-job/{id}','HomeController@edit_job_posted')->middleware('user_logout');
Route::match(['get','post'],'/edit-profile','HomeController@edit_profile')->middleware('user_logout');
Route::post('/exist-mail','HomeController@exist_mail');
Route::post('/exist-mobile','HomeController@exist_mobile');
Route::post('/exist-mobile-number','HomeController@exist_mobile_number');
Route::post('/get-file','HomeController@job_attachment');
Route::post('/delete-attachment','HomeController@delete_attachment')->middleware('user_logout');

Route::get('/get-details','UserController@get_details');

Route::post('/invited-builder-list','UserController@invited_builder_list')->middleware('user_logout');
Route::post('/builder-proposal-list','UserController@builder_proposal_list')->middleware('user_logout');
Route::post('/hire-builder','UserController@hire_builder')->middleware('user_logout');
Route::get('/jobs-given','UserController@jobs_given')->middleware('user_logout');
Route::post('/review-post','UserController@review_post')->middleware('user_logout');
Route::post('/report-builder','UserController@report_builder')->middleware('user_logout');
Route::get('/delete-job/{id}','HomeController@delete_job')->middleware('user_logout');
Route::post('/invited-builder','UserController@invited_builder')->middleware('user_logout');
Route::get('/{page}','HomeController@static_page')->where('page', 'about-us|post-job|terms-and-conditions|builders-faq|landLords-faq|privacy-policy|how-it-works|etc');
Route::post('/send-recommend-us-mail','UserController@send_recommend_us_mail')->middleware('user_logout');
/*Provider */
Route::get('/my-profile','ProviderController@my_profile')->middleware('user_logout');
Route::post('/prof-description-secend-block','ProviderController@prof_description_secend_block')->middleware('user_logout');
Route::get('/profile/{prof_slug}','ProviderController@view_tradesman_profile');
Route::post('/prof-description-first-block','ProviderController@prof_description_first_block')->middleware('user_logout');;
Route::get('/prof-description-third-block','ProviderController@prof_description_third_block')->middleware('user_logout');;
Route::post('/prof-description-portpolio-block','ProviderController@prof_description_portpolio_block')->middleware('user_logout');;
Route::post('/prof-description-logo-block','ProviderController@prof_description_logo_block')->middleware('user_logout');;
Route::post('/prof-pic-upload','ProviderController@prof_pic_upload')->middleware('user_logout');
Route::post('/provider-quote-submit','ProviderController@provider_quote_submit')->middleware('user_logout');
Route::post('/provider-mark-complete-job','ProviderController@provider_mark_complete_job')->middleware('user_logout');
Route::post('/request-feedback','ProviderController@request_feedback')->middleware('user_logout');
Route::match(['get','post'],'/my-awarded-job','ProviderController@awarded_provider_job')->middleware('user_logout');
Route::get('/my-invited','ProviderController@my_invited')->middleware('user_logout');
Route::get('/my-credits', 'ProviderController@my_credits')->name('my-credits')->middleware('user_logout');
Route::post('change-card-details', 'ProviderController@change_card_details')->middleware('user_logout');
Route::post('renew-package', 'ProviderController@renew_package')->middleware('user_logout');
/*Admin*/
Route::get('/admin',function(){	return view('admin.admin_login');});
Route::post('admin-login','admin\HomeController@login');
Route::get('admin-logout','admin\HomeController@logout');
Route::group(['middleware'=>'admin_login'],function(){
	Route::get('/admin-dashboard','admin\HomeController@dashboard');
	Route::match(['post','get'],'/admin-change-password','admin\HomeController@change_password');
	Route::match(['get', 'post'],'/admin-customers-list','admin\UserController@customers_list');
	Route::get('/admin-customer-status/{id}','admin\UserController@customer_status');
	Route::get('/admin-customer-details/{id}','admin\UserController@customer_details');
	Route::get('/admin-customer-approve/{id}','admin\UserController@customer_approve');
	Route::match(['get', 'post'],'/admin-tradesmen-list','admin\UserController@tradesmen_list');
	Route::get('/admin-tradesmen-status/{id}','admin\UserController@tradesmen_status');
	Route::get('/admin-tradesmen-details/{id}','admin\UserController@tradesmen_details');
	Route::get('/admin-tradesmen-delete/{id}','admin\UserController@tradesmen_delete');
	Route::get('/admin-tradesmen-approve/{id}','admin\UserController@tradesmen_approve');
	Route::match(['get', 'post'],'/admin-package-list','admin\UserController@package_list');
	Route::match(['get', 'post'],'/admin-edit-package/{id}','admin\UserController@edit_package');
	Route::get('/admin-package-status/{id}','admin\UserController@package_status');
	Route::match(['get', 'post'],'/admin-category-list','admin\CategoryController@index');
	Route::match(['get', 'post'],'/admin-add-category','admin\CategoryController@add_category');
	Route::match(['get', 'post'],'/admin-edit-category/{id}','admin\CategoryController@edit_category');
	Route::get('/admin-category-status/{id}','admin\CategoryController@category_status');
	Route::get('/admin-category-delete/{id}','admin\CategoryController@delete_category');
	//job
	Route::match(['get', 'post'],'admin-posted-job-list','admin\JobController@posted_job_list');
	Route::get('/admin-posted-job-status/{id}','admin\JobController@change_job_status');
	Route::get('/admin-view-job-details/{id}','admin\JobController@view_job_details');
	Route::match(['get', 'post'],'/admin-change-credential','admin\UserController@change_credential');
	Route::match(['get', 'post'],'/admin-builder-report-list','admin\UserController@builder_report');
	Route::get('/admin-builder-report-details/{id}','admin\UserController@builder_report_details');
	Route::get('/admin-static-page-list','admin\HomeController@static_page_list');
	Route::match(['get', 'post'],'/admin-edit-static-page/{id}','admin\HomeController@edit_static_page');
	Route::match(['get', 'post'],'/admin-static-image','admin\HomeController@upload_image');
	Route::get('/admin-page-status/{id}','admin\HomeController@page_status');
});
Route::get('/404-not-found',function(){
	return view('error.404');
});
Route::get('verify-identity','HomeController@verify_identity');
Route::POST('stripe','StripeController@postPaymentWithStripe')->name('paywithstripe');
Route::get('stripe', 'StripeController@payWithStripe')->name('stripform');
Route::post('credit-package-buy', 'StripeController@payment_for_credit_from_dashboard')->name('stripform');

Route::get('membershipAutoRenewal', 'AutoRenewalMembershipController@fnToRenewMembership');
// Route::post('webhook/stripe', [ 'as' => 'stripe.webhook', 'uses' => 'WebhookController@handleWebhook' ]);
Route::get('webhook/stripe', 'StripeController@handleWebhook');
Route::get('twilio','TwilioController@fnToSendSmsForTradesmanRegistration');