@extends('layout.app')
@section('title','Sign In')
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
						<h2>Sign In</h2>
						@if(session()->get('reset_password_message'))
						<div class="alert alert-success">{{session()->get('reset_password_message')}}</div>
						@endif
						@if(@session()->get('msg'))
						<div class="alert alert-danger "><?=session()->get('msg')?></div>@endif
						@if(@session()->get('success'))
						<div class="alert alert-success">{{session()->get('success')}}</div>@endif
						<form action="login" method="post" id="login">
							{{csrf_field()}}
							<div class="log_form1">
								<input type="text" placeholder="Email" name="email" class="required" autocomplete="new-email">
								<span><img src="images/email11.png" alt=""></span>
							</div>
							<div class="log_form1">
								<input type="password" placeholder="Password" name="password" class="required" autocomplete="new-password">
								<span><img src="images/lock_1.png" alt=""></span>
							</div>
							<input type="submit" value="Login">
							<div class="checkbox-group"> 
								<input id="checkize" type="checkbox"> 
								<label for="checkize" class="">
								<span class="check find_chek"></span>
								<span class="box W25 boxx"></span>
								<h6>Keep me signed in</h6>
								</label>
							</div>
							<div class="forgot_password">
								<a href="forget-password">Forgot Password?</a>
							</div>
							<div class="login_bottom">
								<span>Don’t have an account?</span> <a href="signup">Signup Now!</a>
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
	$('#login').validate();
});
</script>
@endsection