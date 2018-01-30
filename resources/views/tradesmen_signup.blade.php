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
					@if(session()->get('registration_id') == "")
						<li><a href="javascript:void(0);" class="pdngL"><span class="rundd">2</span> Verify your identity</a></li>
						<li><a href="javascript:void(0);" class="pdngL nbdr"><span class="rundd">3</span> Payment</a></li>
					@else
						<li><a href="identity-verification" class="pdngL"><span class="rundd">2</span> Verify your identity</a></li>
						<li><a href="payment" class="pdngL nbdr"><span class="rundd">3</span> Payment</a></li>
					@endif
				</ul>
			</div> 
			<div class="clearfix"></div>
			<div class="setup_frm">
				<h5>Set -up your account</h5>
				<form id="tradesmen_frm" action="tradesmen-signup" method="post">
				{{csrf_field()}}
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="lftitl">
							<div class="your-mail">
								<label>Title</label>
								<select class="form-control newdrop3 required" name="sur_name">
									<option value="">Title</option>
									<option value="1" @if(@$user->sur_name == 1){{'selected'}}@endif>Mr.</option>
									<option value="2" @if(@$user->sur_name == 2){{'selected'}}@endif>Mrs.</option>
									<option value="3" @if(@$user->sur_name == 3){{'selected'}}@endif>Ms.</option>
								</select>
							</div>
						</div>
						<div class="lftitl2">
							<div class="your-mail">
								<label>Name</label>
								<input class="form-control required" placeholder="Type your name" name="user_name" type="text" value="{{@$user->user_name}}">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Role within the Business</label>
							<select class="form-control newdrop3 required" name="business_role">
								<option value="">Business </option>
								<option value="1" @if(@$user->business_role == 1){{'selected'}}@endif>Partner</option>
								<option value="2" @if(@$user->business_role == 2){{'selected'}}@endif>Provider</option>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Email Address</label>
							{{--  @if(session()->get('registration_id') == "")  --}}
							<input class="form-control required" placeholder="Type your email address" name="email" id="email" type="email">
							{{--  @else
								<label style="margin-top:10px;">{{@$user->email}}</label>
							@endif  --}}
						</div>
					</div>
					<h5>Company details</h5>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Company Name</label>
							<input class="form-control required" placeholder="Type your company name" name="company_name" type="text" value="{{@$user->company_name}}">
						</div>
					</div>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Primary Trade</label>
							<select class="form-control newdrop3 required" name="primary_trade">
								<option value="">Select your primary trade</option>
								@if(!$category->isEmpty())
									@foreach($category as $cat)
										<option value="{{@$cat->category_id}}" @if(@$cat->category_id == @$user->primary_trade){{'selected'}}@endif>{{@$cat->category_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Business Type</label>
							<select class="form-control newdrop3 required" name="business_type">
								<option value="">Select your business type</option>
								<option value="1" @if(@$user->business_type == 1){{'selected'}}@endif>Business Type 1</option>
								<option value="2" @if(@$user->business_type == 2){{'selected'}}@endif>Business Type 2</option>
								<option value="3" @if(@$user->business_type == 3){{'selected'}}@endif>Business Type 3</option>
								<option value="4" @if(@$user->business_type == 4){{'selected'}}@endif>Business Type 4</option>
							</select>
						</div>
					</div>
					<h5>Contact information</h5>  
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Mobile</label>
							<input class="form-control required" placeholder="Type your mobile no" name="mobile" type="text" id="mobile" minlength="10" maxlength="10" onkeypress="validate(event)" value="{{@$user->mobile}}">
						</div>
					</div>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Post Code</label>
							<input class="form-control required" placeholder="Type your post code" name="post_code" type="text" autocomplete="new-email" onkeypress="validate(event)" value="{{@$user->post_code}}">
						</div>
					</div>
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Address</label>
							<input type="text" class="form-control required" name="address" id="city" placeholder="Address" value="@if(@$user->address){{@$user->address}}@endif">
							<input type="hidden" id="longitude" name="longitude" value="@if(@$user->longitude){{@$user->longitude}}@endif">
							<input type="hidden" id="lattitude" name="lattitude" value="@if(@$user->lattitude){{@$user->lattitude}}@endif">
						</div>
					</div>
					<h5>Account Password</h5> 
					<div class="col-md-4 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Password</label>
							<input class="form-control required" placeholder="Type your password" type="password" name="password" autocomplete="new-password">
						</div>
					</div>
				
					<div class="col-md-12">
						<div class="fnsh">
							<input value="next" type="submit">
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
	@include('layout.footer')
</div>
<script>
$(document).ready(function(){
	$('#tradesmen_frm').validate();
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
	$('#mobile').blur(function(){
		var mobile = $('#mobile').val();
		var token =" {{ csrf_token() }}";
		if(mobile != "")
		{
			$.ajax({
				method:"POST",
				url:"<?php echo url('exist-mobile')?>",
				dataType: 'JSON',
				data:{
					_token:token,
					mobile:mobile
				},
				success:function(result)
				{
					if(result.msg == 2)
					{
						$('#mobile').css('border','');
						return true;
					}
					else
					{
						$('#mobile').val('');
						$('#mobile').attr('placeholder','Mobile Number already exist');
						$('#mobile').css('border','2px solid #FF0000');
						$('#mobile').focus();
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
function validate(evt){
	var theEvent=evt || window.event;
	var key=theEvent.keyCode || theEvent.which;
	key=String.fromCharCode(key);
	var regex = /[0-9]||\./;
	if(!regex.test(key)){
		theEvent.returnValue=false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}
var country_code = "UK";		
var countryRestrict = {'country': country_code};
var acOptions1 = {
	componentRestrictions: countryRestrict
};
var input = document.getElementById('city');
var autocomplete = new google.maps.places.Autocomplete(input,acOptions1);
 google.maps.event.addListener(autocomplete, 'place_changed', function() {
//input.className = '';
var place = autocomplete.getPlace();
document.getElementById('longitude').value = place.geometry.location.lng();
document.getElementById('lattitude').value = place.geometry.location.lat();
});
</script>
@endsection