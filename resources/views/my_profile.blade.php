@extends('layout.app')
@section('title','My Profile')
@section('body')
<!--wrapper start-->
<div class="row Nomarg">
		@include('provider_header')
      <div class="inner_banner_builder NopaddB"> <img src="images/inner_banner.jpg"  alt="inner_banner"> </div>
    </div>	
		<div class="row Nomarg">
		<div class="container">
		<div class="profile_brief">
          <div class="bborder_ddiv">
        <div class="builder_pprofile_div">
		<div class="upload-image-preview">
		<img src="{{$prof_image}}" class="img-circle img-ppic"> 
		</div>
		<a class="edit_iico" href="#">
		<img src="images/edit_l.png" ></a>
			<form method="post" action="prof-pic-upload" id="prof-pic-upload" enctype="multipart/form-data" >
			{{csrf_field()}}
			 <input type="file" id="imgupload" name="prof_image" style="display:none"/>
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
              <div class="edit_div"><a href="#" class="pull-right"><img src="images/edit_icco.png"></a></div>
              <div class="catt1 col-md-9">
               <ul>
                   <li><img src="images/cat01.png" alt="cat">Category : <span>{{$provider_primary_trade}}</span></li>
                   <li><img src="images/cat02.png" alt="cat">Years in Biz : <span>{{$year_in_biz}}</span>
				   </li>
                   <li><img src="images/cat03.png" alt="cat">Qualification : <span> {{$qualification}}</span></li>
                  <li><img src="images/cat04.png" alt="cat">Location : <span>{{$location}}</span></li>                  
                   <li><img src="images/cat06.png" alt="cat">Insurance : <span> {{$insurance}}</span></li>
                   <li><img src="images/cat08.png" alt="cat">Emergency Job : <span>{{$emergency_job}}</span></li>                 
                  <li><img src="images/cat10.png" alt="cat">Team: <span>{{$team}}</span></li>
                   <li><img src="images/cat11.png" alt="cat">Working Hours : <span>{{$working_hours}}</span></li>
                   <li><img src="images/cat12.png" alt="cat">Member Since : <span> {{$member_since}}</span></li>
                 </ul>
          </div>
		  <div class="mapps">
            <div class="google-maps">
				 <div id="mapCanvas"></div>
                </div>
				
          </div>
	<div class="col-md-12 edited_cat" style="display:none">
	<form action="prof-description-secend-block" method="post" id="prof-description-secend-block">
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Category</label>
	   <select class="form-control required" name="primary_trade">
	   @foreach($provider_category as $row)
	   <option value="{{$row->category_id}}" 
	   @if($provider_primary_id==$row->category_id)
		   selected
		@endif   
	   >{{$row->category_name}}</option>
	   @endforeach	   
	   </select>
	   </div>
	</div>
	
	{{csrf_field()}}
	 <div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Location</label><input class="form-control required" placeholder="Type your company name" id="location" name="location" type="text" value="{{$location}}"></div>
	   <input id="lattitude" name="lattitude" type="hidden" size="50" value="{{$lattitude}}">
	    <input id="longitude" name="longitude" type="hidden" size="50" value="{{$longitude}}">
	  </div>
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Team</label><input class="form-control required" placeholder="Type about your team" name="team" type="text" value="{{$team}}"></div>
	</div>
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Years in Biz</label><input class="form-control required" placeholder="year in biz" name="year_in_biz" type="text" value="{{$year_in_biz}}"></div>
	</div>
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Emergency Job</label>
	   <select class="form-control required" name="emergency_job"> 
	   <option value="1" >Yes</option>
	   <option value="0" >No</option>	    
	   </select>
	   </div>
	</div>
	
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Qualification</label>	   
	   
	   <input class="form-control required" placeholder="Type your company name" name="qualification" type="text" value="{{$qualification}}"></div>
	 
	</div>
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Insurance</label>
	   <select class="form-control required" name="insurance"> 
	   <option value="1" @if($insurance==1) selected @endif >Yes</option>
	   <option value="0" @if($insurance==0) selected @endif >No</option>	    
	   </select></div>
	 </div>
	<div class="col-md-4 col-sm-6 co-xs-12">
	   <div class="your-mail"><label>Working Hours</label>
	   <div class="col-md-6">
	   <div class="your-mail"><label>From</label>
	   <input class="form-control required" placeholder="Type your company name" name="from_time" type="text" id="from_time" value="{{$hours_from}}">
	   </div>
	   </div>
	   <div class="col-md-6">
	   <div class="your-mail"><label>To</label>
	   <input class="form-control required" placeholder="Type your company name" name="to_time" type="text" id="to_time" value="{{$hours_to}}">
	   </div>
	   </div>
	   </div>
	</div>
	<button type="submit" class="btn btn-primary mark_com pull-right post_bbttn">Submit</button>
	</form>
	<div class="check_box_ddiv">
        <div class="checkbox-group1">
              <input form="prof-description-secend-block" id="checkize" name="holiday_notification" value="1" type="checkbox"  {{$holiday_notification}}>
              <label for="checkize" class="">
              <span class="check find_chek"></span> <span class="box W25 boxx"></span>
              <h6>I'm on Holiday and will don't want to receive invites.</h6>
              </label>
            </div>
      </div>
	</div>
	</div>      
     </div>
      
        
        </div>
    <div class="clearfix"></div>
    <div class="portfolio_sec">
          <div class="portfolio_top_panel">
        <h3>Portfolio</h3>
        <a class="add_new_portfolio" href="#">add new portfolio</a></div>
          <div class="clearfix"></div>
          <div class="portfolio_photo_panel">
        <ul>
		 @if(@$port_polio)
			 @foreach($port_polio as $polio)
            <li>
            <h3 class="bbfore">Before</h3>
            <a class="fancybox" href="{{url('public/portpolio_normal/'.$polio->before_image)}}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
              <div class="view1 view-first"> <img src="{{url('public/portpolio_thumbnail/'.$polio->before_image)}}" />
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
              <div class="view1 view-first"> <img src="{{url('public/portpolio_thumbnail/'.$polio->after_image)}}" />
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
              <!--  <li><a class="fancybox" href="images/9_b.jpg" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                <div class="view1 view-first"> <img src="images/9_s.jpg" />
                <div class="mask">
                    <h2>Dummy caption here</h2>
                    <div class="cross_p"><i class="fa fa-times" aria-hidden="true"></i> </div>
                  </div>
              </div>
                </a></li>
              <li><a class="fancybox" href="images/10_b.jpg" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                <div class="view1 view-first"> <img src="images/10_s.jpg" />
                <div class="mask">
                    <h2>Dummy caption here</h2>
                    <div class="cross_p"><i class="fa fa-times" aria-hidden="true"></i> </div>
                  </div>
              </div>
                </a></li>-->
            </ul>
      </div>
        </div>
    <div class="clearfix"></div>
    <div class="qualification_panel">
          <h3>Qualification</h3>
          <div class="clearfix"></div>
          <div class="engg_panel">
          <h3>{{$qualification}}</h3>
        <a href="#" class="pull-right"><img src="images/edit_icco.png"></a></div>
		
        </div>
    <div class="mmember_panel">
          <h3>Member of</h3>
          <a class="add_new_logo" href="#">add new Logo</a>
          <div class="clearfix"></div>
        <ul class="logo_image">
		@if($provider_logo)
			@foreach($provider_logo as $logo)
			 <li><a href="javascript:void(0)"><img src="{{url('public/logo_image/'.$logo->logo_image)}}"></a></li>
			@endforeach
		@endif
      </ul>
        </div>
    <div class="clearfix"></div>
    <div class="review_panel">
          <div class="review_panel_toop">
        <h3>Reviews</h3>
       <!-- <a href="#" class="pull-right"><img src="images/edit_icco.png"></a>
	   -->
		</div>
          <div class="clearfix"></div>
          <div class="review_bblock_11">
        <h3>Light & Power - Internal</h3>
        <div class="pull-right">
              <div class="review_sub">
            <ul>
                  <li><img src="images/sstar.png"></li>
                  <li><img src="images/sstar.png"></li>
                  <li><img src="images/sstar.png"></li>
                  <li><img src="images/sstar.png"></li>
                  <li><img src="images/sstar_1.png"></li>
                </ul>
          </div>
            </div>
        <div class="clearfix"></div>
        <div class="review_bblock_12">
              <ul>
            <li><span><img src="images/user.png" alt="user"></span>Monica, NW6</li>
            <li><span><img src="images/cals.png"></span>Feb 10, 2017</li>
          </ul>
            </div>
        <div class="clearfix"></div>
        <div class="review_ddes"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five the centuries.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
      </div>
        </div>
  </div>
    </div>
</div>
</div>


<footer class="footer_area">
      <div class="container">
    <div class="row">
          <div class="top-footer">
        <div class="col-md-5 col-sm-12 col-xs-12">
              <div class="fot_box"> <a class="fot_logo" href="#"><img src="images/logo.png" alt=""></a>
            <p>Lorem Ipsum is simply dummy or caption text of the printing and typesetting industry, this is a simply dummy or caption text here.</p>
          </div>
            </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
              <div class="fot_box fot_box_tow">
            <h3>Information</h3>
            <ul>
                  <li><a href="#">Builders FAQ</a></li>
                  <li><a href="#">Terms & Conditions</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                </ul>
            <ul>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Help</a></li>
                 <!-- <li><a href="#">Contact Us</a></li>-->
                </ul>
          </div>
            </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
              <div class="fot_box social">
            <h3>We Are Social</h3>
            <ul>
                  <li> <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a> </li>
                  <li> <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a> </li>
                  <li> <a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a> </li>
                </ul>
          </div>
            </div>
      </div>
          <div class="below_footer">
        <p>Copyrights © 2017 LandLordRepairs all Rights Reserved</p>
      </div>
        </div>
  </div>
    </footer>

<!-- Return to Top --> 
<a href="javascript:" id="return-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>
<!--wrapper end--> 

<script>
	// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
</script> 
<script>
var marker;
var input;
var latLng;

function initialize(lattitude,longitude) {
		latLng = new google.maps.LatLng(lattitude,longitude);
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
		function removePreviousMarker(map){
				 marker.setMap(map);
				}
		google.maps.event.addListener(marker, 'dragend', function() {
			console.log('dfgdfg');
			 document.getElementById('longitude').value = marker.getPosition().lng();
			 document.getElementById('lattitude').value = marker.getPosition().lat(); 
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
			 $('.errorLatLng').css('visibility','hidden')		 
		});
	}
	 var longitude=document.getElementById('longitude').value;
	 var lattitude=document.getElementById('lattitude').value;
	google.maps.event.addDomListener(window, 'load', initialize(lattitude,longitude));
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
                  <div class="radio_area">
                     <form action="prof-description-portpolio-block" method="post" enctype="multipart/form-data">
					 {{csrf_field()}}
                        <div class="col-md-6">
                           <button type="button" id="before_image" class="btn btn-primary">Choose before image</button>
                           <div class="before_image view-first" style="width:18%"></div>
                           <input type="file" id="before_image_file_id" name="before_image" style="display:none"> 
											   
                           <input type="text" class="form-control"  name="before_image_caption" placeholder="before image caption"> 
                        </div>
                    
                     <div class="col-md-6">
                        <button type="button" id="after_image" class="btn btn-primary">Choose after image</button>
                        <div class="after_image view-first" style="width: 18%;"></div>
                        <input type="file" id="after_image_file_id" name="after_image" style="display:none">                    
                        <input type="text" class="form-control" name="after_image_caption" placeholder="after image caption">
                     </div>
                     <input type="submit" class="btn btn-primary mark_com pull-left post_bbttn" vlaue="Submit">
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
            <h4 class="modal-title">Image of logo </h4>
         </div>
         <div class="modal-body review_modal_body1 NopaddB">
            <div class="col-md-12 popad">
               <div class="recomnd">
                  <div class="radio_area">
                     <form action="prof-description-logo-block" method="post" enctype="multipart/form-data">
					 {{csrf_field()}}
                        <div class="col-md-6">                          
                           <div class="logo_view_image" style="width:18%"></div>
                           <input type="file" name="logo_image" id="logo_image">
                        </div>
                     <input type="submit" class="btn btn-primary mark_com pull-left post_bbttn" value="upload">
					  </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
