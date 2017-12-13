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
					<li class="active"><a href="payment" class="pdngL nbdr"><span class="rundd">3</span> Payment</a></li>
				</ul>
			</div> 
			<div class="clearfix"></div>
			<div class="setup_frm ">
				<h5>Payment</h5>
				<div class="clearfix"></div>
				<div class="alert alert-info" style="font-size: 15px;font-weight: 600;font-family: -webkit-body;">
				Payment will be intigrated for upcoming milestone.</strong>
				</div>
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