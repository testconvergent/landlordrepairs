@extends('layout.app')
@section('title','Reset Password')
@section('body')
<div class="wrapper">
	<header class="header_area">
		<div class="top_head top_part_02 wow fadeInDown" data-wow-delay="0.7s">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="logo">
							<a href="{{url('/')}}"><img src="images/logo_1.png" alt=""></a>
						</div>
						<div class="log_area ns">
							<ul>
								<li class="log_btn"><a href="signup">Signup</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section class="about_land login_bg signup_bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="login_box for_padd login_box2">
						<img src="images/forgot.png" alt="">
						<h2>Reset Password</h2>
						@if(@session()->get('success'))
						<div class="alert alert-success">{{session()->get('success')}}</div>@endif
						@if(@session()->get('msg'))
						<div class="alert alert-danger">{{session()->get('msg')}}</div>@endif
						<form action="submit-reset-password" method="post" id="reset_password_frm">
							{{csrf_field()}}
							<div class="log_form1 fullbg">
								<input type="password" placeholder="Password" name="password" id="password" class="required">
								<span><img src="images/email11.png" alt=""></span>
							</div>
							<div class="log_form1 fullbg">
								<input type="password" placeholder="Confirm Password" name="confirm_password" class="required">
								<span><img src="images/email11.png" alt=""></span>
							</div>
							<input type="submit" value="Submit">
						</form>
					</div> 
				</div>
			</div>
		</div>
	</section>
    </div>
@include('layout.footer')
<script>
$(document).ready(function(){
	$('#reset_password_frm').validate({
		rules: {
		  password: "required",
		  confirm_password: {
			equalTo: "#password"
		  }
		}
	  });
});
</script>
@endsection