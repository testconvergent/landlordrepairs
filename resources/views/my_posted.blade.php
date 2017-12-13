@extends('layout.app')
@section('title','My Job Posted')
@section('body')
@include('layout.customer_header')
	<div class="row Nomarg">
		<div class="contain_divs">
			<div class="container">
				@if(!$get_job->isEmpty())
					@foreach($get_job as $job)
						<div class="col-sm-6 col-lg-6 col-md-6">
							<div class="awaded_jobs_block user_pos">
								<h3>{{@$job->looking_for}}</h3>
								<div class="edt">
									<a href="javascript:void(0);" data-id="{{@$job->job_id}}" data-looking_for="{{@$job->looking_for}}" data-budget="{{@$job->budget}}" data-deadline="{{@$job->deadline}}"data-city="{{@$job->city}}" data-zip_code="{{@$job->zip_code}}" data-job_details="{{@$job->job_details}}" data-job_type_id="{{@$job->job_type_id}}" data-job_cat_id="{{@$job->category_id}}" data-lattitude="{{@$job->lattitude}}" data-longitude="{{@$job->longitude}}" class="edit_job"><img src="images/edit.png" alt=""></a>
									<a href="javascript:void(0);"><img src="images/ext.png" alt=""></a>
								</div>
								<div class="clearfix"></div>
								<div class="awaded_type">
									<ul>
										<li><img src="images/ico03.png">Job Category : {{@$job->category_name}}</li>
										<li><img src="images/ico04.png">Type : {{@$job->job_type_name}}</li>
									</ul>
								</div>
								<div class="clearfix"></div>
								<div class="awaded_des">
									<p class="show">{{@$job->job_details}}</p>
								</div>
								<div class="clearfix"></div>
								<div class="awarded_btn_group">
									<div class="bbtn_lleft_p">
										<button data-toggle="modal" data-target="#myModal2" type="button" class="btn btn-primary mark_com">Invited Builders</button>
										<button data-toggle="modal" data-target="#myModal3" type="button" class="btn btn-primary recommend_us">View Proposals (12)</button>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="bottom_footer_bbox">
									<ul>
										<li class="lloc"><span><img src="images/loc.png" ></span>{{@$job->city}}</li>
										<li class="lloc_2"><span><img src="images/ccal.png" ></span>Deadline: {{date('d F Y',strtotime(@$job->deadline))}}</li>
									</ul>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
 <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Review Modal content-->
    <div class="modal-content bborder_bottom">
      <div class="modal-header review_modal_header">
        <button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
</button>
        <h4 class="modal-title">Recommend us </h4>
      </div>
      <div class="modal-body review_modal_body1 NopaddB">
     <form class="modal_form_rreview">
     
     <div class="col-md-12 popad">
     	<div class="recomnd">
        	<h5>Recommend us to a </h5>
            <div class="radio_area">
            	  <p>
                    <input type="radio" id="test1" name="radio-group" checked>
                    <label for="test1">Tradesperson </label>
                  </p>
                  <p>
                    <input type="radio" id="test2" name="radio-group">
                    <label for="test2"> Landlord </label>
                  </p>
            </div>
            <button type="button" class="btn btn-primary mark_com pull-left post_bbttn">Submit</button>
        </div>
     </div>

     </form>
       
     
     
        
        
        
   
      </div>
      
    </div>

  </div>
</div> 
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog invite_modil">

    <!-- Review Modal content-->
    <div class="modal-content bborder_bottom">
      <div class="modal-header review_modal_header">
        <button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
</button>
        <h4 class="modal-title">Invite Builder</h4>
      </div>
      <div class="modal-body review_modal_body1 NopaddB inv">
     <form class="modal_form_rreview">
     
     <div class="col-md-12 popad">
     	<div class="invite_pop">
        	<p>Builder in some job category near job location</p>
            <div class="scr">
            	<div class="invite_box">
            	<div class="invite_img">
                	<img src="images/imag_ppic.jpg" alt="">
                </div>
                <div class="invie_del">
                	<h4>Janet Jackson</h4>
                    <span><img src="images/black.png" alt="">Plumbers</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been dummy text the industry's standard dummy text ever since the, when an.</p>
                </div>
                <div class="invite_rev">
                	<ul>
                    	<li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar_1.png" alt=""></li>
                    </ul>
                    <a class="invite_btn" href="#"><img src="images/luser.png" alt=""> Invite</a>
                    <a class="invite_btn viw_pf" href="#"><img src="images/eyes.png" alt=""> View Profile</a>
                </div>
            </div>
            	<div class="invite_box">
            	<div class="invite_img">
                	<img src="images/imag_ppic.jpg" alt="">
                </div>
                <div class="invie_del">
                	<h4>Janet Jackson</h4>
                    <span><img src="images/black.png" alt="">Plumbers</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been dummy text the industry's standard dummy text ever since the, when an.</p>
                </div>
                <div class="invite_rev">
                	<ul>
                    	<li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar_1.png" alt=""></li>
                    </ul>
                    <a class="invite_btn" href="#"><img src="images/luser.png" alt=""> Invite</a>
                    <a class="invite_btn viw_pf" href="#"><img src="images/eyes.png" alt=""> View Profile</a>
                </div>
            </div>
            	<div class="invite_box">
            	<div class="invite_img">
                	<img src="images/imag_ppic.jpg" alt="">
                </div>
                <div class="invie_del">
                	<h4>Janet Jackson</h4>
                    <span><img src="images/black.png" alt="">Plumbers</span>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been dummy text the industry's standard dummy text ever since the, when an.</p>
                </div>
                <div class="invite_rev">
                	<ul>
                    	<li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar.png" alt=""></li>
                        <li><img src="images/sstar_1.png" alt=""></li>
                    </ul>
                    <a class="invite_btn" href="#"><img src="images/luser.png" alt=""> Invite</a>
                    <a class="invite_btn viw_pf" href="#"><img src="images/eyes.png" alt=""> View Profile</a>
                </div>
            </div>
            </div>
        </div>
     </div>

     </form>
       
     
     
        
        
        
   
      </div>
      
    </div>

  </div>
</div> 
<!-- Modal4 newjob -->
<div id="myModal4" class="modal fade" role="dialog">
	<div class="modal-dialog invite_modil">
    <!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title">New Jobs</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB inv_1">
				<form class="modal_form_rreview" method="post" action="post-job" id="job_post_frm" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Job Type</label>
							<select class="pop_select" name="job_type_id" id="job_type_id">
							<option value="">Job type</option>
							@if(!$job_type->isEmpty())
								@foreach($job_type as $job)
									<option value="{{@$job->job_type_id}}">{{@$job->job_type_name}}</option>
								@endforeach
							@endif
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Category</label>
							<select class="pop_select" name="job_category_id" id="job_category_id">
								<option value="">Category</option>
								@if(!$category->isEmpty())
									@foreach($category as $cat)
										<option value="{{@$cat->category_id}}">{{@$cat->category_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="pwd">Looking For</label>
							<input type="text" class="form-control" name="looking_for" id="looking_for" placeholder="Looking for">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Budget</label>
							<input type="text" class="form-control" name="budget" id="budget" placeholder="Budget (£)" onkeypress="validate(event)">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Deadline</label>
							<div class="ccal">
								<img src="images/call.png" >
								<input type="text" class="form-control" id="datepicker" name="deadline" placeholder="Deadline" >
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">City</label>
							<input type="text" class="form-control" name="city" id="city" placeholder="City">
							<input type="hidden" id="longitude" name="longitude">
							<input type="hidden" id="lattitude" name="lattitude">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Zipcode</label>
							<input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Zip Code">
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control" rows="3" id="comment" name="job_details"></textarea>
						</div>
					</div>
					<div class="col-sm-5 col-lg-5 col-md-5">
						<div class="form-group">
							<div class="Uploadbtn">
								<input type="file" id="uploadBtn1" class="input-upload" name="attachment[]" multiple>
								<span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
							</div>
							<span class="fil_txt1"></span>
						</div>
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<span class="span_erro"></span>
					</div>
					<div class="col-sm-3 col-lg-3 col-md-3">
						<button type="submit" class="btn btn-primary mark_com pull-right MargT30 post_bbttn">Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> 
<div id="myModal5" class="modal fade" role="dialog">
	<div class="modal-dialog invite_modil">
    <!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title">Edit Jobs</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB inv_1">
				<form class="modal_form_rreview" method="post" action="edit-post-job" id="job_post_frm1" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Job Type</label>
							<select class="pop_select" name="job_type_id" id="job_type_id">
							<option value="">Job type</option>
							@if(!$job_type->isEmpty())
								@foreach($job_type as $job)
									<option value="{{@$job->job_type_id}}">{{@$job->job_type_name}}</option>
								@endforeach
							@endif
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Category</label>
							<select class="pop_select" name="job_category_id" id="job_category_id">
								<option value="">Category</option>
								@if(!$category->isEmpty())
									@foreach($category as $cat)
										<option value="{{@$cat->category_id}}">{{@$cat->category_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="pwd">Looking For</label>
							<input type="text" class="form-control" name="looking_for" id="looking_for" placeholder="Looking for">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Budget</label>
							<input type="text" class="form-control" name="budget" id="budget" placeholder="Budget (£)" onkeypress="validate(event)">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Deadline</label>
							<div class="ccal">
								<img src="images/call.png" >
								<input type="text" class="form-control" id="datepicker" name="deadline" placeholder="Deadline" >
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">City</label>
							<input type="text" class="form-control" name="city" id="city" placeholder="City">
							<input type="hidden" id="longitude" name="longitude">
							<input type="hidden" id="lattitude" name="lattitude">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Zipcode</label>
							<input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Zip Code">
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control" rows="3" id="comment" name="job_details"></textarea>
						</div>
					</div>
					<div class="col-sm-5 col-lg-5 col-md-5">
						<div class="form-group">
							<div class="Uploadbtn">
								<input type="file" id="uploadBtn2" class="input-upload" name="attachment[]" multiple>
								<span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
							</div>
						</div>
						<span class="fil_txt1"></span>
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<span class="span_erro"></span>
					</div>
					<div class="col-sm-3 col-lg-3 col-md-3">
						<button type="submit" class="btn btn-primary mark_com pull-right MargT30 post_bbttn">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@include('layout.footer')
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<style>
.span_erro{
	color: red;
    font-weight: bold;
    margin-left: 2px;
    margin-top: 20px;
    width: 100%;
    float: left;
}
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}
.show {
    font:normal 15px arial;
    text-align: justify;
	padding: 15px 0 0 0;
}
.morectnt span {
display: none;
}
.showmoretxt {
    font: bold 15px tahoma;
    text-decoration: none;
}
.fil_txt1 {
    float: left;
    background-color: rgba(152, 132, 132, 0.3);
    border-radius: 3px;
    font-size: 11px;
    font-family: roboto, sans-serif;
    font-weight: 300;
    color: #000;
    padding: 5px;
    font-style: italic;
    margin-right: 15px;
	display:none;
}
</style>
<script>
$(document).ready(function(){
	$('#job_post_frm,#job_post_frm1').submit(function(){
		if($(this).find('#job_type_id').val() == "")
		{
			$('.span_erro').html('Job type is required');
			return false;
		}
		else if($(this).find('#job_category_id').val() == "")
		{
			$('.span_erro').html('Job category is required');
			return false;
		}
		else if($(this).find('#looking_for').val() == "")
		{
			$('.span_erro').html('Looking for is required');
			return false;
		}
		else if($(this).find('#budget').val() == "")
		{
			$('.span_erro').html('Budget is required');
			return false;
		}
		else if($(this).find('#datepicker').val() == "")
		{
			$('.span_erro').html('Deadline is required');
			return false;
		}
		else if($(this).find('#city').val() == "")
		{
			$('.span_erro').html('City is required');
			return false;
		}
		else if($(this).find('#zip_code').val() == "")
		{
			$('.span_erro').html('Zipcode is required');
			return false;
		}
		else if($(this).find('#job_details').val() == "")
		{
			$('.span_erro').html('Job Details is required');
			return false;
		}
		else
		{
			return true;
		}
	});
	$('.edit_job').click(function(){	
		$("#myModal5 #job_post_frm1").attr("action", "edit-post-job/" + $(this).data('id'));
		$("#myModal5 #job_type_id").val($(this).data('job_type_id'));
		$("#myModal5 #job_category_id").val($(this).data('job_cat_id'));
		$("#myModal5 #looking_for").val($(this).data('looking_for'));
		$("#myModal5 #budget").val($(this).data('budget'));
		$("#myModal5 #datepicker").val($(this).data('deadline'));
		$("#myModal5 #zip_code").val($(this).data('zip_code'));
		$("#myModal5 #city").val($(this).data('city'));
		$("#myModal5 #longitude").val($(this).data('longitude'));
		$("#myModal5 #lattitude").val($(this).data('lattitude'));
		$("#myModal5 #comment").val($(this).data('job_details'));
		$('#myModal5').modal("show");
	});
	$('body').on('change','#uploadBtn1',function(){//alert();
		$(".fil_txt1").show();
		  var filename = this.value;
		  var lastIndex = filename.lastIndexOf("\\");
		  if (lastIndex >= 0) {
			 filename = filename.substring(lastIndex + 1);
		  }
		  var files = $('#uploadBtn1')[0].files;
		  for (var i = 0; i < files.length; i++) {
			$(".fil_txt1").append(files[i].name+"<br>");
		  }
		  document.getElementById('filename').value = filename;
		  });
	 $('body').on('change','#uploadBtn2',function(){
		 $(".fil_txt1").show();
		  var filename = this.value;
		  var lastIndex = filename.lastIndexOf("\\");
		  if (lastIndex >= 0) {
			 filename = filename.substring(lastIndex + 1);
		  }
		  var files = $('#uploadBtn2')[0].files;
		  for (var i = 0; i < files.length; i++) {
			$(".fil_txt1").append(files[i].name+"<br>");
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
var input = document.getElementById('city');
var autocomplete = new google.maps.places.Autocomplete(input);
 google.maps.event.addListener(autocomplete, 'place_changed', function() {
//input.className = '';
var place = autocomplete.getPlace();
document.getElementById('longitude').value = place.geometry.location.lng();
document.getElementById('lattitude').value = place.geometry.location.lat();
});

$(function() {
var showTotalChar = 180, showChar = "", hideChar = "";
$('.show').each(function() {
var content = $(this).text();
if (content.length > showTotalChar) {
var con = content.substr(0, showTotalChar);
var hcon = content.substr(showTotalChar, content.length - showTotalChar);
var txt= con +  '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
$(this).html(txt);
}
});
});
<?php if(session()->get('edit') == 'success'){?>
swal(
  'Good job!',
  'Job edited successfully.',
  'success'
)
<?php } 
session()->put('edit','');
?>
</script>
@endsection