@extends('layout.app')
@section('title','My Posted Jobs')
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
								<a href="javascript:void(0);" onclick="delete_job({{$job->job_id}})"><img src="images/ext.png" alt=""></a>
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
									<button data-id="{{$job->job_id}}" type="button" class="btn btn-primary mark_com invited">Invited Builders</button>
									<?php $get_proposal = count_proposal($job->job_id);?>
									<button type="button" data-id="{{$job->job_id}}" class="btn btn-primary recommend_us view_proposal">View Proposals ({{count($get_proposal)}})</button>
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
					@if($loop->iteration%2==0)
						<div class="clear"></div>
					@endif
				@endforeach
				@else
					<div class="norecordfound">
					<p>No Jobs Found.</p>
					</div>
			@endif
		</div>
	</div>
</div>
<!--Invite Builder-->
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
						<div class="invite_pop invi_user">
							<div class="">
								
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Invite Builder-->
<!--Builder Proposal-->
<div id="myModal3" class="modal fade" role="dialog">
	<div class="modal-dialog invite_modil">
		<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title">View Proposal</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB inv">
				<form class="modal_form_rreview">
					<div class="col-md-12 popad">
						<div class="invite_pop">
							<!--<p>Builder in some job category near job location</p>-->
							<div class="scr proposal">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Builder Proposal-->
<!--Edit Job-->
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
								<input type="text" class="form-control" id="datepicker1" name="deadline" placeholder="Deadline" style="background:#fff" readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">City</label>
							<input type="text" class="form-control" name="city" id="address" placeholder="City">
							<input type="hidden" id="address_longitude" name="longitude">
							<input type="hidden" id="address_lattitude" name="lattitude">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Post Code</label>
							<input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Post Code">
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
				<div class="clearfix"></div>
				<div class="atta">
					
				</div>
			</div>
		</div>
	</div>
</div>
<!--Edit Job-->
@include('layout.customer_footer')
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<style>
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
.show1 {
    font:normal 15px arial;
    text-align: justify;
	padding: 15px 0 0 0;
}
.morectnt span {
display: none;
}
.morectnt1 span {
display: none;
}
.showmoretxt {
    font: bold 15px tahoma;
    text-decoration: none;
}
.showmoretxt1 {
    font: bold 15px tahoma;
    text-decoration: none;
}
.no_invited{
    font-size: 20px;
    font-family: initial;
    font-weight: 700;
    color: #de4c4c;
    text-align: center;
    background-color: #e0e0e0;
    margin: 36px 8px 6px 0px;
}
</style>
<script>
$(document).on('click','.read_more',function(event){
event.preventDefault();
$(this).parents('.invite_box').find('.show1').toggle();
$(this).parents('.invite_box').find('.collapse').collapse('toggle');
});

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
		else if($(this).find('input[name="deadline"]').val() == "")
		{
			$('.span_erro').html('Deadline is required');
			return false;
		}
		else if($(this).find('input[name="city"]').val() == "")
		{
			$('.span_erro').html('City is required');
			return false;
		}
		else if($(this).find('#zip_code').val() == "")
		{
			$('.span_erro').html('Post Code is required');
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
		var job_id = $(this).data('id');
		var token =" {{ csrf_token() }}";
		$.ajax({
			method:"POST",
			url:"<?php echo url('get-file')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				job_id:job_id
			},
			success:function(result)
			{
				if(result.attach == 'no')
				{
					
				}
				else
				{
					$('.atta').html(result.attach);
				}
			},
			error:function(error){
				console.log(error.responseText);
			} 
		});
		$("#myModal5 #job_post_frm1").attr("action", "edit-post-job/" + $(this).data('id'));
		$("#myModal5 #job_type_id").val($(this).data('job_type_id'));
		$("#myModal5 #job_category_id").val($(this).data('job_cat_id'));
		$("#myModal5 #looking_for").val($(this).data('looking_for'));
		$("#myModal5 #budget").val($(this).data('budget'));
		$("#myModal5 #datepicker1").val($(this).data('deadline'));
		$("#myModal5 #zip_code").val($(this).data('zip_code'));
		$("#myModal5 #address").val($(this).data('city'));
		$("#myModal5 #address_longitude").val($(this).data('longitude'));
		$("#myModal5 #address_lattitude").val($(this).data('lattitude'));
		$("#myModal5 #comment").val($(this).data('job_details'));
		$('#myModal5').modal("show");
	});
	$('.invited').click(function(){
		var job_id = $(this).data('id');
		//alert(category_id);
		var token =" {{ csrf_token() }}";
		$.ajax({
			method:"POST",
			url:"<?php echo url('invited-builder-list')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				job_id:job_id
			},
			success:function(result)
			{
				$('#myModal2').modal("show");
				$('.invi_user').html(result.user_html);	
			},
			error:function(error){
				console.log(error.responseText);
			} 
		});
	});
	$('.view_proposal').click(function(){
		var job_id = $(this).data('id');
		//alert(category_id);
		var token =" {{ csrf_token() }}";
		$.ajax({
			method:"POST",
			url:"<?php echo url('builder-proposal-list')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				job_id:job_id
			},
			success:function(result)
			{
				$('#myModal3').modal("show");
				$('.proposal').html(result.proposal_html);	
			},
			error:function(error){
				console.log(error.responseText);
			} 
		});
	});
	$('body').on('click','.invited_user',function(){
		var builder_id = $(this).data('id');
		var job_id = $(this).data('job_id');
		var token =" {{ csrf_token() }}";
		$.ajax({
			method:"POST",
			url:"<?php echo url('invited-builder')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				builder_id:builder_id,
				job_id:job_id
			},
			success:function(result)
			{
				//alert(result.invited);
				if(result.invited == 1)
				{
					$('#invite_'+builder_id).html('<i class="fa fa-check-circle" aria-hidden="true"></i> invited');
					$('#invite_'+builder_id).removeClass('invited_user');
					$('#invite_'+builder_id).removeClass('invite_btn');
					$('#invite_'+builder_id).addClass('invited_btn');
				}
				//$('.scr').html(result.user_html);	
			},
			error:function(error){
				console.log(error.responseText);
			} 
		});
	});
	$('body').on('click','.hired',function(){
		var job_invitation_id = $(this).data('id');
		var token =" {{ csrf_token() }}";
		$.ajax({
			method:"POST",
			url:"<?php echo url('hire-builder')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				job_invitation_id:job_invitation_id
			},
			success:function(result)
			{
				//alert(result.hired);
				if(result.hired == 1)
				{
					/* $('#hire_'+job_invitation_id).html('<i class="fa fa-handshake-o" aria-hidden="true"></i> Hired');
					$('#hire_'+job_invitation_id).removeClass('hired');
					$('#hire_'+job_invitation_id).removeClass('invite_btn');
					$('#hire_'+job_invitation_id).addClass('invited_btn'); */
					$('.hired').hide();
					window.location.assign('<?php echo url('jobs-given');?>');
				}
				//$('.scr').html(result.user_html);	
			},
			error:function(error){
				console.log(error.responseText);
			} 
		});
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
	$('body').on('click','.delete_attachment',function(){
		var attachment_id = $(this).data('id');
		var token =" {{ csrf_token() }}";
		$.ajax({
			method:"POST",
			url:"<?php echo url('delete-attachment')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				attachment_id:attachment_id
			},
			success:function(result)
			{
				if(result.delete == 1)
				{
					$('#attach_file_'+attachment_id).remove();
				}
				else
				{
					
				}
			},
			error:function(error){
				console.log(error.responseText);
			} 
		});
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

var country_code = "UK";		
var countryRestrict = {'country': country_code};
var acOptions1 = {
	componentRestrictions: countryRestrict
};
var input = document.getElementById('address');
var autocomplete = new google.maps.places.Autocomplete(input,acOptions1);
 google.maps.event.addListener(autocomplete, 'place_changed', function() {
//input.className = '';
var place = autocomplete.getPlace();
document.getElementById('address_longitude').value = place.geometry.location.lng();
document.getElementById('address_lattitude').value = place.geometry.location.lat();
});

$(function() {
var showTotalChar = 160, showChar = "", hideChar = "";
$('.show').each(function() {
var content = $(this).text();
if (content.length > showTotalChar) {
var con = content.substr(0, showTotalChar);
var hcon = content.substr(showTotalChar, content.length - showTotalChar);
var txt= con +  '<span class="dots">...</span><span class="morectnt1"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
$(this).html(txt);
}
});
});
$(function() {
var showTotalChar1 = 10, showChar1 = "View More >>", hideChar1 = "<< View Less";
$('.show1').each(function() {
var content = $(this).text();
if (content.length > showTotalChar1) {
var con = content.substr(0, showTotalChar1);
var hcon = content.substr(showTotalChar1, content.length - showTotalChar1);
var txt= con +  '<span class="dots">...</span><span class="morectnt1"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt1">' + showChar1 + '</a></span>';
$(this).html(txt);
}
});
$(".showmoretxt1").click(function() {
if ($(this).hasClass("sample")) {
$(this).removeClass("sample");
$(this).text(showChar1);
} else {
$(this).addClass("sample");
$(this).text(hideChar1);
}
$(this).parent().prev().toggle();
$(this).prev().toggle();
return false;
});
});
function delete_job(id)
	{
		//alert(id);
		swal({   title: "Are you sure?",   
		text: "You want to delete this job?",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete it!",   
		cancelButtonText: "No, cancel!",   
		closeOnConfirm: false,   
		closeOnCancel: true 
		}, 
		function(isConfirm)
		{   
			if (isConfirm)
			{
				window.location.assign("<?php echo url('/');?>/delete-job/"+id);	
			} 
			
		});
	}
</script>
@if(session()->get('success'))
<script>
swal(
  'Success',
  '{{session()->get("success")}}',
  'success'
)
</script>
@endif
@endsection