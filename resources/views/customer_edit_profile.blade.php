@extends('layout.app')
@section('title','Edit Profile')
@section('body')
@include('layout.customer_header')
<section class="personal_password">
	<div class="container">
    	<div class="row">
        	<div class="final_action">
				<div class="col-md-12">
					<div class="allrt_edit">
						@if(@session()->get('success'))
						<div class=" alert alert-success fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
					</div>
				</div>
            	<form action="edit-profile" id="edit_frm" method="post">
					{{csrf_field()}}
                	<h5>Personal information</h5>
                    <div class="col-md-12">
                        <div class="your-mail">
                      		<label>User Name</label>
                       		<input class="form-control required" placeholder="User name" type="text" name="user_name" value="{{@$user->user_name}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                    	<label class="email">Email : {{@$user->email}}</label>
                    </div>
                    <div class="col-md-12">
                        <div class="your-mail">
                      		<label>Phone Number</label>
                       		<input class="form-control required" placeholder="Phone number" type="text" autocomplete="new-user_mobile" minlength="10" maxlength="10" onkeypress="validate(event)" id="mobile" value="{{@$user->mobile}}" name="mobile">
                        </div>
                    </div>
					<?php 
					if(@$user->working_hours){
						$working_hours=explode('-',$user->working_hours);
						//echo $working_hours[0];
					}
					?>
					<div class="col-md-6 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Working Hours From</label>
							<input class="form-control required" placeholder="From hours" name="from_time" type="text" id="from_time" value="{{@$working_hours[0]}}">
						</div>
					</div>
					<div class="col-md-6 col-sm-6 co-xs-12">
						<div class="your-mail">
							<label>Working Hours To</label>
							<input class="form-control required" placeholder="To hours" name="to_time" type="text" id="to_time" value="{{@$working_hours[1]}}">
						</div>
					</div>
                    <h5>Password</h5>
                    <div class="col-md-12">
                        <div class="your-mail">
                      		<label>Change Password</label>
                       		<input class="form-control required" placeholder="Change your password" type="password" name="password" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="your-mail">
                            <input value="Update" type="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
<script>
$(document).ready(function(){
	$('#edit_frm').validate();
$('#mobile').blur(function(){
		var mobile = $('#mobile').val();
		var token =" {{ csrf_token() }}";
		if(mobile != "")
		{
			$.ajax({
				method:"POST",
				url:"<?php echo url('exist-mobile-number')?>",
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
$('#from_time').timepicker();
$('#to_time').timepicker();
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
</script>
@endsection