@extends('layout.app')
@section('title','Verification')
@section('body')
<div class="wrapper">
	<header class="header_area">
		@include('layout.header')
	</header>
	<section class="about_land login_bg signup_bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="login_box login_box2">
						<img src="images/login_logo.png" alt="">
						@if(session()->get('message') == 'mail-verification')
							<h2 style="margin-bottom: 5px !important;">Email Verified</h2>
							<span class="mess_span">You have successfully verify your email. Now you can login your register email and password.</span><br>
						@else
							<h2 style="margin-bottom: 5px !important;">Verification</h2>
							<span class="mess_span">A verification link has been sent to your register email address. Please verify your account.</span><br>
						
							<span class="mess_span">A mobile verification code has been sent to your register mobile number. Please enter your code in bellow text. Mobile Verification code is {{session()->get('mobile_vcode')}}</span>
							<form action="verification" method="post" id="verification_frm">
							{{csrf_field()}}
								<div class="log_form1">
									<input type="text" placeholder="Enter Mobile Verification Code" name="code" class="required" autocomplete="new-email" maxlength="4" minlength="4">
									<span><img src="images/mobile.png" alt=""></span>
								</div>
								<input type="submit" value="Apply">
							</form>
						@endif
						<div class="login_bottom">
							<span>Already a Member ?</span> <a href="login">Login Now!</a>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</section>
	@include('layout.footer')
</div>
<style>
.mess_span{
	font-size: 14px;
    text-align: left;
    float: left;
    color: #242722;
    background: #ecf0f1;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 3px;
	font-weight: 700;
	font-family: initial;
    box-shadow: 3px 6px #c7c7c7;
}
</style>
<script>
$(document).ready(function(){
	$('#verification_frm').validate();
});
</script>
@endsection