@extends('layout.app')
@section('title','Tradesmen Signup')
@section('body')
<div class="wrapper">
	<header class="header_area">
		@include('layout.header')
		<div class="tradesmen"><img src="images/tradesmen.jpg" alt="">
			<div class="iner_contain">
				<div class="container">
					<div class="left_cntent">
						<h2>Connect with new customers today</h2>
						<ul>
							<li><img src="images/lfrarw.png" alt=""> Sign up now to start receiving job leads</li>
							<li><img src="images/lfrarw.png" alt=""> Buy the leads you want</li>
							<li><img src="images/lfrarw.png" alt=""> win the work & get rated</li>
						</ul>
						<!--<button type="submit" class="btn sub_bttn sgnw">sign up now</button>-->
					</div>
				</div>
			</div>
        </div>
	</header>
	<div class="tradesmen_signup">
		<div class="container">
			<div class="bred">
				<ul>
					<li class="active"><a href="tradesmen-signup"><span class="rundd">1</span>Set-up your account</a></li>
					<li class="active"><a href="identity-verification" class="pdngL"><span class="rundd">2</span> Verify your identity</a></li>
					<li ><a href="#" class="pdngL nbdr"><span class="rundd">3</span> Payment</a></li>
				</ul>
			</div> 
			<div class="clearfix"></div>
			<div class="setup_frm ">
				<h5>Verify your identity</h5>
				<div class="clearfix"></div>
				@if(session()->get('email_not_verified')!='')
				<div class="alert alert-success" style="font-size: 15px;font-weight: 600;font-family: -webkit-body;">
				A verification link has been sent to your register email address. Please verify your account.
				</div>
				@endif
				<div class="clearfix"></div>
				@if(session()->get('mobile_not_verified')!='')
				<div class="alert alert-info" style="font-size: 15px;font-weight: 600;font-family: -webkit-body;">
				
					A mobile verification code has been sent to your register mobile number. Please enter your code in bellow text. code is {{@session()->get('mobile_code')}}</strong>
				</div>				
				<form id="tradesmen_frm" action="identity-verification" method="post" class="mak_frm">
				{{csrf_field()}}
					<div class="col-md-8 col-sm-8 co-xs-12">
						<div class="your-mail">
							<label>Phone verification Code</label>
							<input class="form-control required" placeholder="Enter Your mobile vcode" name="code" id="email" type="text">
						</div>
					</div>
					<div class="col-md-12">
						<div class="fnsh">
							<input value="next" type="submit">
						</div>
					</div>
				</form>
				@endif
			</div>
		</div>
	</div>
	@include('layout.footer')
</div>
<script>
$(document).ready(function(){
	$('#tradesmen_frm').validate();
});
</script>
@endsection