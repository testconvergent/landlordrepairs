@extends('layout.app') 
@section('title','Builder Profile') 
@section('body')
<!--wrapper start-->
<div class="row Nomarg">
    @include('layout.customer_header')
</div>
<div class="row Nomarg">
    <div class="container">
        <div class="profile_brief">
            <div class="bborder_ddiv">
                <div class="builder_pprofile_div">
                    <div class="upload-image-preview">
                        <img src="{{$prof_image}}" class="img-circle img-ppic">
                    </div>
                     <!-- <a class="edit_iico" href="javascript:void(0);">
                        <img src="images/edit_l.png"></a>
						-->
                    <form method="post" action="prof-pic-upload" id="prof-pic-upload" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="file" id="imgupload" name="prof_image" style="display:none" />
                        <div class="submit_prof_pic">
                        </div>
                    </form>
                    <div class="ssocialss">
                        <p>Follow Us :</p>
                        <div class="ssoalss_iico"> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
						<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
						<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> 
						<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </div>
                    </div>
                </div>
                <form action="prof-description-first-block" method="post" id="prov_form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="dess">
                        <div class="title_description">
                            <h3>{{$prof_title}}<!--<a href="#" class="pull-right"><img src="images/edit_icco.png"></a> --></h3>
                        </div>
                        <div class="title_description">
                            <p>{{$prof_description}} </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bborder_ddiv">
                <div class="catts">
                    <div class="edit_div">
                        <!-- <a href="#" class="pull-right"><img src="images/edit_icco.png"></a> -->
                    </div>
					
                    <div class="catt1 col-md-9">
                        <ul>
                            <li><img src="images/cat01.png" alt="cat">
                                <p>Category : <span>{{$provider_primary_trade}}</span></p>
                            </li>
                            <li><img src="images/cat02.png" alt="cat">
                                <p>Years in Biz : <span>{{$year_in_biz}}</span></p>
                            </li>
                            <li><img src="images/cat03.png" alt="cat">
                                <p>Qualification : <span> {{$qualification}}</span></p>
                            </li>
                            <li><img src="images/cat04.png" alt="cat">
                                <p>Location : <span>{{$location}}</span></p>
                            </li>
                        </ul>
                        <ul>
                            <li><img src="images/cat06.png" alt="cat">
                                <p>Insurance : <span> {{$insurance}}</span></p>
                            </li>
                            <li><img src="images/cat08.png" alt="cat">
                                <p>Emergency Job : <span>{{$emergency_job}}</span></p>
                            </li>
                            <li><img src="images/cat10.png" alt="cat">
                                <p>Team: <span>{{$team}}</span></p>
                            </li>
                            <li><img src="images/cat11.png" alt="cat">
                                <p>Working Hours : <span>{{$working_hours}}</span></p>
                            </li>
                            <li><img src="images/cat12.png" alt="cat">
                                <p>Member Since : <span> {{$member_since}}</span></p>
                            </li>
                        </ul>
                    </div>
                    <div class="mapps">
                        <div class="google-maps">
                            <div id="mapCanvas"></div>
							<input id="lattitude_1" name="lattitude" type="hidden" size="50" value="{{$lattitude}}">
                            <input id="longitude_1" name="longitude" type="hidden" size="50" value="{{$longitude}}">
                        </div>

                    </div>

                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="portfolio_sec">
			   @if(count($port_polio))
                <div class="portfolio_top_panel">
                    <h3>Portfolio</h3>
                 </div>
                <div class="clearfix"></div>
                <div class="portfolio_photo_panel">
                    <ul>
                         @foreach($port_polio as $polio)
                        <li>
                            <h3 class="bbfore">Before</h3>
                            <a class="fancybox" href="{{url('public/portpolio_normal/'.$polio->before_image)}}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                                <div class="view1 view-first"> <img src="{{url('public/portpolio_normal/'.$polio->before_image)}}" />
                                    <div class="mask">
                                        <h2>{{$polio->before_image_caption}}</h2>
                                        <div class="cross_p"><i class="fa fa-times" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <h3 class="bbfore">After</h3>
                            <a class="fancybox" href="{{url('public/portpolio_normal/'.$polio->after_image)}}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                                <div class="view1 view-first"> <img src="{{url('public/portpolio_normal/'.$polio->after_image)}}" />
                                    <div class="mask">
                                        <h2>{{$polio->after_image_caption}}</h2>
                                        <div class="cross_p"><i class="fa fa-times" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach 
                    </ul>
                </div>
				@else
				<div class="review_panel">
				 <h3>Portfolio not available.</h3> 
				</div>				
				@endif
            </div>
            <div class="clearfix"></div>
            <div class="qualification_panel">
                <h3>Qualification</h3>
                <div class="clearfix"></div>
                <div class="engg_panel">
                    <h3>{{$qualification}}</h3>                    
                </div>
            </div>
            <div class="mmember_panel">
			 @if(count($provider_logo)) 
                <h3>Member of</h3>                
                <div class="clearfix"></div>
                <ul class="logo_image">                    
						@foreach($provider_logo as $logo)
                    <li><a href="javascript:void(0)"><img src="{{url('public/logo_image/'.$logo->logo_image)}}"></a></li>
                    @endforeach 
					
                </ul>
				@else
					<div class="review_panel">
					<h3>Currently not a member of any organization.</h3>
					</div>
				@endif
            </div>
            <div class="clearfix"></div>
            <div class="review_panel">
                
				@if(count($review))
					<div class="review_panel_toop">
                    <h3>Reviews</h3>
                </div>
                <div class="clearfix"></div>
				<div class="reviewarea">
						@foreach($review as $rev)
						<div class="review_bblock_11 ">
							<h3>{{@$rev->review_title}}</h3>
							<div class="pull-right">
								<div class="review_sub">
									<ul>
										<?php 
										$review_point = floor(@$rev->ave_review);
										for($i=1;$i<=5;$i++){
										if($i <= $review_point){?>
											<li><img src="images/sstar.png" alt=""></li>
											<?php
											}
											else{?>
											<li><img src="images/sstar_1.png" alt=""></li>
											<?php
											}
										}?>
									</ul>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="review_bblock_12">
								<ul>
									<li><span><img src="images/user.png" alt="user"></span>{{$rev->review->user_name}}</li>
									<li><span><img src="images/cals.png"></span>{{date('M d, Y',strtotime(@$rev->review_date))}}</li>
								</ul>
							</div>
							<div class="clearfix"></div>
							<div class="review_ddes">{{@$rev->comments}}.</div><hr>
						</div>
						@endforeach
				</div>
				@else
					<h3>No reviews found.</h3>
				@endif
            </div>
        </div>
    </div>
</div>
</div>
@include('layout.footer')
<script type="text/javascript" src="js/jquery.slimscroll.js"></script>
<script>
    var marker;
    var input;
    var latLng;

    function initialize(lattitude, longitude) {
        latLng = new google.maps.LatLng(lattitude, longitude);
        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: 10,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false

        });
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
            draggable: true,
            title: "Sie können mich per Drag & Drop auf das gewünschte Ziel setzen. Oder im Suche feld den Ort eingeben und auswählen."
        });

        function removePreviousMarker(map) {
            marker.setMap(map);
        }
        google.maps.event.addListener(marker, 'dragend', function() {
            //console.log('dfgdfg');
            //document.getElementById('longitude').value = marker.getPosition().lng();
            //document.getElementById('lattitude').value = marker.getPosition().lat(); 
        });
        google.maps.event.addListener(map, 'click', function(event) {
            removePreviousMarker(null);
            latLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
            marker = new google.maps.Marker({
                position: latLng,
                map: map,
                draggable: true,
            });
            //document.getElementById('longitude').value = latLng.lng();
            //document.getElementById('latitude').value = latLng.lat(); 
            $('.errorLatLng').css('visibility', 'hidden')
        });
    }
    var longitude = document.getElementById('longitude_1').value;
    var lattitude = document.getElementById('lattitude_1').value;
    google.maps.event.addDomListener(window, 'load', initialize(lattitude, longitude));
	
	$(function(){
		$('.reviewarea').slimScroll({
			height: '300px',
			scrollTo: '200500px' 
		});
	}); 
</script>
<!--wrapper end-->
@if(session()->get('success'))
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script>
    swal(
        'Success',
        '{{session()->get("success")}}',
        'success'
    )
</script>
@endif @endsection