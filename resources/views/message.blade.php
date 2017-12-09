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
					<div class="message_board">
						<h1>Registration Sucessfully</h1>
						<span>A verification link has been sent to your register email address. Please verify your account.</span></br>
						<span>A mobile verification code has been sent to your register mobile number. Please enter your code in bellow text.</span>
						<form action="verification" method="post" id="verification_frm">
							{{csrf_field()}}
							<div class="cuponne_area">
								<input type="text" placeholder="Enter Code" name="code" class="required">
								<input type="submit" value="Apply">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('layout.footer')
</div>
<script>
$(document).ready(function(){
	$('#verification_frm').validate();
});
</script>
@endsection