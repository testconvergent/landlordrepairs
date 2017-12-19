@extends('layout.app') @section('title','My Profile') @section('body')
<!--wrapper start-->
<div class="row Nomarg">
    @include('layout.provider_header')
    <div class="inner_banner_builder NopaddB"> <img src="images/inner_banner.jpg" alt="inner_banner"> </div>
</div>
<div class="row Nomarg">
    <div class="container">
        <div class="profile_brief">
            <div class="bborder_ddiv">
                <div class="builder_pprofile_div">
                    <div class="upload-image-preview">
                        <img src="{{$prof_image}}" class="img-circle img-ppic">
                    </div>
                    <a class="edit_iico" href="javascript:void(0);"><img src="images/edit_l.png"></a>
                    <form method="post" action="prof-pic-upload" id="prof-pic-upload" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="file" id="imgupload" name="prof_image" style="display:none" />
                        <div class="submit_prof_pic">
                        </div>
                    </form>
                    <div class="ssocialss">
                        <p>Follow Us :</p>
                        <div class="ssoalss_iico"> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </div>
                    </div>
                </div>
                <form action="prof-description-first-block" method="post" id="prov_form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="dess">
                        <div class="title_description">
                            <h3>{{$prof_title}}<a href="#" class="pull-right"><img src="images/edit_icco.png"></a></h3>
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
                        <a href="#" class="pull-right"><img src="images/edit_icco.png"></a>
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
                        </div>
                    </div>
                    <div class="col-md-12 edited_cat" style="display:none;padding:0px;">
                        <form action="prof-description-secend-block" method="post" id="prof-description-secend-block">
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Category</label>
                                    <select class="form-control newdrop3 required" name="primary_trade">
                                        @foreach($provider_category as $row)
                                        <option value="{{$row->category_id}}" @if($provider_primary_id==$row->category_id) selected @endif >{{$row->category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{csrf_field()}}
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Location</label>
                                    <input class="form-control required" placeholder="Type your company name" id="location" name="location" type="text" value="{{$location}}">
                                </div>
                                <input id="lattitude" name="lattitude" type="hidden" size="50" value="{{$lattitude}}">
                                <input id="longitude" name="longitude" type="hidden" size="50" value="{{$longitude}}">
                            </div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Team</label>
                                    <input class="form-control required" placeholder="Type about your team" name="team" type="text" value="{{$team}}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Years in Biz</label>
                                    <input class="form-control required" placeholder="year in biz" name="year_in_biz" type="text" value="{{$year_in_biz}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Emergency Job</label>
                                    <select class="form-control newdrop3 required" name="emergency_job">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Qualification</label>

                                    <input class="form-control required" placeholder="Type your company name" name="qualification" type="text" value="{{$qualification}}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Insurance</label>
                                    <select class="form-control newdrop3 required" name="insurance">
                                        <option value="1" @if($insurance==1) selected @endif>Yes</option>
                                        <option value="0" @if($insurance==0) selected @endif>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Working Hours From</label>
                                    <input class="form-control required" placeholder="Type your company name" name="from_time" type="text" id="from_time" value="{{$hours_from}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 co-xs-12">
                                <div class="your-mail">
                                    <label>Working Hours To</label>
                                    <input class="form-control required" placeholder="Type your company name" name="to_time" type="text" id="to_time" value="{{$hours_to}}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="check_box_ddiv">
                                <div class="checkbox-group1">
                                    <input form="prof-description-secend-block" id="checkize" name="holiday_notification" value="1" type="checkbox" {{$holiday_notification}}>
                                    <label for="checkize" class="">
                                        <span class="check find_chek"></span> <span class="box W25 boxx"></span>
                                        <h6>I'm on Holiday and will don't want to receive invites.</h6>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 co-xs-12" style="float:right;">
                                <button type="submit" class="btn btn-primary mark_com pull-right post_bbttn">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="portfolio_sec">
            <div class="portfolio_top_panel">
                <h3>Portfolio</h3>
                <a id="portpolio_button" class="add_new_portfolio" href="#">add new portfolio</a></div>
            <div class="clearfix"></div>
            <div class="portfolio_photo_panel">
                <ul>
                    @if(@$port_polio) @foreach($port_polio as $polio)
                    <li>
                        <h3 class="bbfore">Before</h3>
                        <a class="fancybox" href="{{url('public/portpolio_normal/'.$polio->before_image)}}" data-fancybox-group="gallery" title="{{$polio->before_image_caption}}">
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
                        <a class="fancybox" href="{{url('public/portpolio_normal/'.$polio->after_image)}}" data-fancybox-group="gallery" title="{{$polio->after_image_caption}}">
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
					@endif
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="qualification_panel">
            <h3>Qualification</h3>
            <div class="clearfix"></div>
            <div class="engg_panel">
                <h3>{{$qualification}}</h3>
                <a href="#" class="pull-right"><img src="images/edit_icco.png"></a>
            </div>
        </div>
        <div class="mmember_panel">
            <h3>Member of</h3>
            <a id="logo_button" class="add_new_portfolio" href="#">add new Logo</a>
            <div class="clearfix"></div>
            <ul class="logo_image">
                @if($provider_logo) @foreach($provider_logo as $logo)
                <li><a href="javascript:void(0)"><img src="{{url('public/logo_image/'.$logo->logo_image)}}"></a></li>
                @endforeach @endif
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="review_panel">
            <div class="review_panel_toop">
                <h3>Reviews</h3>
            </div>
            <div class="clearfix"></div>
            <div class="review_bblock_11 reviewarea">
				@if(!$review->isEmpty())
					@foreach($review as $rev)
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
					@endforeach
				@endif
			</div>
        </div>
    </div>
</div>
@include('layout.builder_footer')
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
    var longitude = document.getElementById('longitude').value;
    var lattitude = document.getElementById('lattitude').value;
    google.maps.event.addDomListener(window, 'load', initialize(lattitude, longitude));
	$(function(){
		$('.reviewarea').slimScroll({
			height: '300px',
			scrollTo: '200500px' 
		});
	}); 
</script>
<!--wrapper end-->
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Review Modal content-->
        <div class="modal-content bborder_bottom">
            <div class="modal-header review_modal_header">
                <button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title">Portfolio </h4>
            </div>
            <div class="modal-body review_modal_body1 NopaddB">
                <div class="col-md-12 popad">
                    <div class="recomnd">
                        <div class="radio_area port_pop">
                            <form action="prof-description-portpolio-block" id="portpolio-frm" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-6">
                                    <div class="before_image view-first"></div>
                                    <div class="upload_icon">
                                        <div class="Uploadbtn">
                                            <input type="file" id="before_image_file_id" name="before_image" class="input-upload required">
                                            <span><b>choose before image</b> <i><img src="images/ddownload.png"></i></span>
                                        </div>
                                    </div>
                                    <div class="upload_caption">
                                        <input type="text" class="form-control builder_type required" name="before_image_caption" placeholder="Before image caption">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="after_image view-first"></div>
                                    <div class="upload_icon">
                                        <div class="Uploadbtn">
                                            <input type="file" id="after_image_file_id" name="after_image" class="input-upload required">
                                            <span> <b>choose after image</b> <i><img src="images/ddownload.png"></i></span>
                                        </div>
                                    </div>
                                    <div class="upload_caption">
                                        <input type="text" class="form-control builder_type required" name="after_image_caption" placeholder="After image caption">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary mark_com pull-left post_bbttn" vlaue="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Review Modal content-->
        <div class="modal-content bborder_bottom">
            <div class="modal-header review_modal_header">
                <button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title">Logo </h4>
            </div>
            <div class="modal-body review_modal_body1 NopaddB">
                <div class="col-md-12 popad">
                    <div class="recomnd modal_logo">
                        <div class="radio_area port_pop">
                            <form action="prof-description-logo-block" id="logo-frm" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="logo_view_image view-first"></div>
                                    <div class="upload_icon">
                                        <div class="Uploadbtn">
                                            <input type="file" name="logo_image" id="logo_image" class="input-upload required">
                                            <span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top:15px;">
                                    <input type="submit" class="btn btn-primary mark_com pull-left post_bbttn" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
@endif
@endsection