@extends('layout.app')
@section('title','Home')
@section('body')
<div class="wrapper">
	<header class="header_area">
		@include('layout.header')
		<div class="banner">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="images/banner_1.jpg" alt="">
					</div>
				</div>
				<div class="banner_contain">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="left_banner">
									<h2>Book local builders trusted by landlords just like you !</h2>
									<ul>
										<li>We are 100% Free</li>
										<li>Get 3 quotes per Job</li>
										<li>Save time & Money</li>
										<li>Avoid Rogue trades</li>
										<li>Made by landlords for landlords</li>
										<li>Make your tenants happy</li>
									</ul>
								</div>
								<div class="desktop_form banner_form">
									<h2>Get started </h2>
									<div class="form_area">
										<form method="post" action="post-job" id="job_post_frm" enctype="multipart/form-data">
											{{csrf_field()}}
											<div class="form-group">
												<select class="form_type form_option" name="job_type_id" id="job_type_id">
													<option value="">Job type</option>
													@if(!$job_type->isEmpty())
														@foreach($job_type as $job)
															<option value="{{@$job->job_type_id}}">{{@$job->job_type_name}}</option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="form-group">
												<select class="form_type form_option" name="job_category_id" id="job_category_id">
													<option value="">Category</option>
													@if(!$category->isEmpty())
														@foreach($category as $cat)
															<option value="{{@$cat->category_id}}">{{@$cat->category_name}}</option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="form-group">
												<input type="text" class="form-control form_type" name="looking_for" id="looking_for" placeholder="Looking for">
											</div>
											<div class="form-group">
												<div class="first">
													<input type="text" class="form-control form_type" name="budget" id="budget" placeholder="Budget (£)" onkeypress="validate(event)">
												</div>
												<div class="second">
													<input type="text" class="form-control form_type form_date" id="datepicker" name="deadline" placeholder="Deadline" >
												</div>
											</div>
											<div class="form-group">
												<div class="first">
													<input type="text" class="form-control form_type " name="city" id="city" placeholder="City">
													<input type="hidden" id="longitude" name="longitude">
													<input type="hidden" id="lattitude" name="lattitude">
												</div>
												<div class="second">
													<input type="text" class="form-control form_type" name="zip_code" id="zip_code" placeholder="Post Code">
												</div>
											</div>
											<div class="form-group">
												<textarea class="form_type form_msg" id="job_details" name="job_details" placeholder="Details"></textarea>
											</div>
                                            <div class="form-group">
                                            	<div class="attach_file">  
                                                    <label class="myLabel">
                                                    <input name="attachment[]" id="attachment" type="file" multiple>
                                                    <span><i class="fa fa-cloud-upload" aria-hidden="true"></i> Attach Files</span>
                                                    </label>
													<span class="fil_txt1"></span>
                                                </div>
                                            </div>
											<div class="form-group ban_btn">
												<button type="submit" class="btn sub_bttn">Next</button>
												<span class="span_erro"></span>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</header>
	<div class="mobile_form">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="banner_form">
						<h2>Get started </h2>
						<div class="form_area">
							<form method="post" action="post-job" id="job_post_frm" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<select class="form_type form_option" name="job_type_id" id="job_type_id">
										<option value="">Job type</option>
										@if(!$job_type->isEmpty())
											@foreach($job_type as $job)
												<option value="{{@$job->job_type_id}}">{{@$job->job_type_name}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<select class="form_type form_option" name="job_category_id" id="job_category_id">
										<option value="">Category</option>
										@if(!$category->isEmpty())
											@foreach($category as $cat)
												<option value="{{@$cat->category_id}}">{{@$cat->category_name}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<input type="text" class="form-control form_type" name="looking_for" id="looking_for" placeholder="Looking for">
								</div>
								<div class="form-group">
									<div class="first">
										<input type="text" class="form-control form_type" name="budget" id="budget" placeholder="Budget (£)" onkeypress="validate(event)">
									</div>
									<div class="second">
										<input type="text" class="form-control form_type form_date" id="datepicker" name="deadline" placeholder="Dateline" >
									</div>
								</div>
								<div class="form-group">
									<div class="first">
										<input type="text" class="form-control form_type " name="city" id="city" placeholder="City">
										<input type="hidden" id="longitude" name="longitude">
										<input type="hidden" id="lattitude" name="lattitude">
									</div>
									<div class="second">
										<input type="text" class="form-control form_type" name="zip_code" id="zip_code" placeholder="Post Code">
									</div>
								</div>
								<div class="form-group">
									<textarea class="form_type form_msg" id="job_details" name="job_details" placeholder="Details"></textarea>
								</div>
								<div class="form-group">
									<div class="attach_file">  
										<label class="myLabel">
										<input name="attachment[]" id="attachment1" type="file" multiple>
										<span><i class="fa fa-cloud-upload" aria-hidden="true"></i> Attach Files</span>
										</label>
										<span class="fil_txt2"></span>
									</div>
								</div>
								<div class="form-group ban_btn">
									<button type="submit" class="btn sub_bttn">Next</button>
									<span class="span_erro"></span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="resource">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="head_tow">Resources</h2>
					<p>Our Mission is simple. We are Here only to support Britain Landlords LandlordRepairs is here only to support landlords to save money and time on all there repairs needs 247! <a href="#"> More <i class="fa fa-caret-right" aria-hidden="true"></i> </a></p>
				</div>
			</div>
		</div>
	</section>
        
	<section class="how_work">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="head_tow">How It Works</h2>
				</div>
				<div class="works_area">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="work_box">
							<img src="images/work_icon1.png" alt="">
							<h3>Post a Job</h3>
							<p>Be mobile with the Landlord Repairs.com iPhone App. Download now from the Apple App Store FREE!</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="work_box">
							<img src="images/work_icon2.png" alt="">
							<h3>Invite Tradesmen</h3>
							<p>Get a feel for the rates that voice talent charge for their voice-over work, recording and production services.</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="work_box">
							<img src="images/work_icon3.png" alt="">
							<h3>Get Quote</h3>
							<p>Read the Beginner's Guide, or the Professional's Guide to Voice Acting to learn about the art of voice acting.</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="work_box">
							<img src="images/work_icon4.png" alt="">
							<h3>Hire</h3>
							<p>Listen to our high-energy podcast and stay up-to-date on industry news and technology trends.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
        
	<section class="about_land">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="head_tow">About Landlord Repairs.com</h2>
					<p>Every now and then a company arises whose steely focus, passion for innovation and burning desire to change the world truly makes an impact. Voices.com strives to achieve amazing things through the talent and faith of ordinary people.</p>
					<p>As our voice talent step up to their microphones, we meet and exceed your expectations with excellence through the spoken word. We get your job done on time, within budget, and most importantly, we'll get your job done right.</p>
					<p>More than 250,000 people from companies like ABC, NBC, ESPN, PBS, The History Channel, The Discovery Channel, Sony Pictures, Audible, Comcast, Bell Canada, Microsoft, Cisco Systems, Western Union, American Airlines, Toyota, Ford and GM as well as organizations such as the US Army and the US Government entrust our online marketplace with their stories and collaborate online.</p>
					<p>People at advertising agencies, financial firms, healthcare organizations, radio stations, publishers and other businesses use our award-winning web application, iPhone app, iPad app and innovative SurePay™ payment service to easily search for and hire narrators, voice actors and professional voice over talent.</p>
				</div>
			</div>
		</div>
	</section>
        
	<section class="popular">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="head_tow">Popular Local Services</h2>
					<span>Find local businesses directly. What are you looking for today</span>
				</div>
				<div class="popular_item">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="#">Architectural Designers</a></li>
							<li><a href="#">Bathroom Fitters</a></li>
							<li><a href="#">Bricklayers</a></li>
							<li><a href="#">Carpenters & Joiners</a></li>
							<li><a href="#">Carpet fitters</a></li>
							<li><a href="#">Chimney & Fireplace Specialists</a></li>
							<li><a href="#">Conservatory Installers</a></li>
							<li><a href="#">Conversion Specialists</a></li>
							<li><a href="#">Damp Proofing Specialists</a></li>
						</ul>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="#">Demolition Contractors</a></li>
							<li><a href="#">Driveway Pavers</a></li>
							<li><a href="#">Electricians</a></li>
							<li><a href="#">Extension Builders</a></li>
							<li><a href="#">Fencers</a></li>
							<li><a href="#">Flooring Fitters</a></li>
							<li><a href="#">Garage & Shed Builders</a></li>
							<li><a href="#">Gas Engineers</a></li>
							<li><a href="#">Groundworkers</a></li>
						</ul>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="#">Handymen</a></li>
							<li><a href="#">Heating Engineers</a></li>
							<li><a href="#">Insulation Installers</a></li>
							<li><a href="#">Kitchen Fitters</a></li>
							<li><a href="#">Landscape Gardeners</a></li>
							<li><a href="#">Loft Conversion Specialists</a></li>
							<li><a href="#">New Home Builders</a></li>
							<li><a href="#">Painters & Decorators</a></li>
							<li><a href="#">Plasterers</a></li>
						</ul>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<ul>
							<li><a href="#">Plumbers</a></li>
							<li><a href="#">Restoration & Refurb Specialists</a></li>
							<li><a href="#">Roofers</a></li>
							<li><a href="#">Security System Installers</a></li>
							<li><a href="#">Stonemasons</a></li>
							<li><a href="#">Tilers</a></li>
							<li><a href="#">Tree Surgeons</a></li>
							<li><a href="#">Window Fitters</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
        
	<section class="why_should">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="head_tow">Why should I use LandlordRepairs?</h2>
				</div>
				<div class="should_area">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="should_box">
							<img src="images/should_icon1.png" alt="">
							<p>100% Free To Use & No Obligation To Hire</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="should_box">
							<img src="images/should_icon2.png" alt="">
							<p>Compare Prices with your existing Builder</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="should_box">
							<img src="images/should_icon3.png" alt="">
							<p>Hire The Best & Avoid Rogue Traders</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="should_box">
							<img src="images/should_icon4.png" alt="">
							<p>Make Your Tenants Happy & Save Money</p>
						</div>
					</div>
				</div>
				<div class="mor">
					<a class="more_bttn" href="#">More</a>
				</div>
			</div>
		</div>
	</section>
        
	<section class="build">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="head_tow">BUILDERS GROW YOUR BUSINESS</h2>
					<span>Thousands of landlords come to Landlord Repairs every day looking to hire service pros just like you</span>
					<a class="more_bttn" href="#">Register your Business</a>
				</div>
			</div>
		</div>
	</section>
	<section class="cliebt">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>As Seen On</h2>
					<ul>
						<li><a href="#"><img src="images/client_1.png" alt=""></a></li>
						<li><a href="#"><img src="images/client_2.png" alt=""></a></li>
						<li><a href="#"><img src="images/client_3.png" alt=""></a></li>
						<li><a href="#"><img src="images/client_4.png" alt=""></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
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
			$('.span_erro').html('Post Code is required');
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
	$('body').on('change','#attachment',function(){
		$(".fil_txt1").show();
		var filename = this.value;
		var lastIndex = filename.lastIndexOf("\\");
		if (lastIndex >= 0) {
		 filename = filename.substring(lastIndex + 1);
		}
		var files = $('#attachment')[0].files;
		for (var i = 0; i < files.length; i++) {
		$(".fil_txt1").append(files[i].name+"<br>");
		}
		document.getElementById('filename').value = filename;
		});
	$('body').on('change','#attachment1',function(){
		$(".fil_txt2").show();
		var filename = this.value;
		var lastIndex = filename.lastIndexOf("\\");
		if (lastIndex >= 0) {
		 filename = filename.substring(lastIndex + 1);
		}
		var files = $('#attachment1')[0].files;
		for (var i = 0; i < files.length; i++) {
		$(".fil_txt2").append(files[i].name+"<br>");
		}
		document.getElementById('filename').value = filename;
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