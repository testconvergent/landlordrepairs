@extends('layout.app')
@section('title','Signup')
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
						<h2>Signup</h2>
						<form id="signup" action="signup" method="post">
							{{csrf_field()}}
							<div class="log_form1">
								<input type="email" placeholder="Email" name="email" id="email" class="required" autocomplete="new-email">
								<span><img src="images/email11.png" alt=""></span>
							</div>
							<div class="log_form1">
								<input type="text" placeholder="Name" name="user_name" class="required">
								<span><img src="images/luser_1.png" alt=""></span>
							</div>
							<div class="log_form1">
								<input type="text" placeholder="Mobile" name="user_mobile" class="required" autocomplete="new-user_mobile">
								<span><img src="images/mobile.png" alt=""></span>
							</div>
							<div class="log_form1">
								<input type="password" placeholder="Password" name="password" class="required" autocomplete="new-password">
								<span><img src="images/lock_1.png" alt=""></span>
							</div>
							<input type="submit" value="Signup">
							<div class="login_bottom">
								<span>Already a Member ?</span> <a href="#">Login Now!</a>
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
	$('#signup').validate();
	$('#email').blur(function(){
		var email = $('#email').val();
		var token =" {{ csrf_token() }}";
		if(email != "")
		{
			$.ajax({
				method:"POST",
				url:"<?php echo url('exist-mail')?>",
				dataType: 'JSON',
				data:{
					_token:token,
					email:email
				},
				success:function(result)
				{
					if(result.msg == 2)
					{
						$('#email').css('border','');
						return true;
					}
					else
					{
						$('#email').val('');
						$('#email').attr('placeholder','Email already exist');
						$('#email').css('border','2px solid #FF0000');
						$('#email').focus();
						return false;
					}
					
				},
				error:function(error){
					console.log(error.responseText);
				} 
			});
		}
	});
});
</script>
@endsection