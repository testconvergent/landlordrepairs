@extends('layout.app')
@section('title','Tradesmen Here')
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
                        <button type="submit" onclick="window.location.href='tradesmen-signup';" class="btn sub_bttn sgnw">sign up now</button>
                    </div>
                    </div>
                </div>
         </div>
	</header>
	<div class="icon_infrm">
        	<div class="container">
            	<div class="col-md-4 col-sm-4">
                	<div class="iconbox">
                    	<div class="iconrund"><img src="images/icon1.png" alt=""></div>
                        <p>Pick and choose from jobs in your local area</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-4">
                	<div class="iconbox">
                    	<div class="iconrund"><img src="images/icon2.png" alt=""></div>
                        <p>Home owners shortlist from intested trades</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-4">
                	<div class="iconbox">
                    	<div class="iconrund"><img src="images/icon3.png" alt=""></div>
                        <p>Contact details area exchanged</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-4">
                	<div class="iconbox">
                    	<div class="iconrund"><img src="images/icon1.png" alt=""></div>
                        <p>More than 4 million job leads posted</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-4">
                	<div class="iconbox">
                    	<div class="iconrund"><img src="images/icon2.png" alt=""></div>
                        <p>Working under top National regulators</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-4">
                	<div class="iconbox">
                    	<div class="iconrund"><img src="images/icon3.png" alt=""></div>
                        <p>1 job posted every 35 seconds</p>
                    </div>
                </div>
                
                
                
            </div>
        </div>
		<div class="mbrsprice">
        	<div class="container">
            	<h2>No Signup Fee, No Membership, Just simple pricing structure.</h2>
                
                <div class="col-md-5 col-sm-5">
                	<table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Job Size</th>
                          <th scope="col">Shortlist Fees</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Up to € 75</td>
                          <td>€ 2</td>
                        </tr>
                        <tr>
                          <td>€ 75 - € 125</td>
                          <td>€ 3</td>
                        </tr>
                        <tr>
                          <td>€ 125 - € 250</td>
                          <td>€ 5</td>
                        </tr>
                        <tr>
                          <td>€ 250 - € 400</td>
                          <td>€ 8</td>
                        </tr>
                        <tr>
                          <td>€ 400 - € 750</td>
                          <td>€ 12</td>
                        </tr>
                        <tr>
                          <td>€ 750 - € 1500</td>
                          <td>€ 18</td>
                        </tr>
                        <tr>
                          <td>€ 1500 - € 3000</td>
                          <td>€ 25</td>
                        </tr>
                        <tr>
                          <td>€ 3000 +</td>
                          <td>€ 35</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                
                <div class="col-sm-7 col-sm-7">
                	<div class="simply_descrp">
                    	<h6>Simply dummy heading text or caption here</h6>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        
                        <h6>Simply dummy heading text</h6>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.</p>
                        
                    </div>
                </div>
                
            </div>
        </div>
		<div class="grow_section">
        	<div class="container">
            	<div class="buisnsgrow">
                <div class="rket"><img src="images/roket.png" alt=""></div>
                <h2>grow your business</h2>
                <p>Our Platform helps you gain new customers, keep your existing customers happy, and manage your business on the go.</p>
                <div class="clearfix"></div>
                <a href="#" class="sgnup">sign up now</a>
                </div>
            </div>
        </div>
	@include('layout.footer')
</div>
<style>
.span_erro{
	color: red;
    font-weight: bold;
    margin-left: 48px;
}
</style>
<script>
$(document).ready(function(){
	$('#job_post_frm').submit(function(){
		if($('#job_type_id').val() == "")
		{
			$('.span_erro').html('Job type is required');
			return false;
		}
		else if($('#job_category_id').val() == "")
		{
			$('.span_erro').html('Job category is required');
			return false;
		}
		else if($('#looking_for').val() == "")
		{
			$('.span_erro').html('Looking for is required');
			return false;
		}
		else if($('#budget').val() == "")
		{
			$('.span_erro').html('Budget is required');
			return false;
		}
		else if($('#datepicker').val() == "")
		{
			$('.span_erro').html('Deadline is required');
			return false;
		}
		else if($('#city').val() == "")
		{
			$('.span_erro').html('City is required');
			return false;
		}
		else if($('#zip_code').val() == "")
		{
			$('.span_erro').html('Zipcode is required');
			return false;
		}
		else if($('#job_details').val() == "")
		{
			$('.span_erro').html('Job Details is required');
			return false;
		}
		else
		{
			return true;
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
var input = document.getElementById('city');
var autocomplete = new google.maps.places.Autocomplete(input);
 google.maps.event.addListener(autocomplete, 'place_changed', function() {
//input.className = '';
var place = autocomplete.getPlace();
document.getElementById('longitude').value = place.geometry.location.lng();
document.getElementById('lattitude').value = place.geometry.location.lat();
});
</script>
@endsection