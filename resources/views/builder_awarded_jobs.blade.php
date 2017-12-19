@extends('layout.app') 
@section('title','My Profile') @section('body')
<!--wrapper start-->
<div class="row Nomarg">
	@include('layout.provider_header')
	<div class="inner_banner_builder"> <img src="images/inner_banner.jpg"  alt="inner_banner">
		<div class="adnew1">
			<form id="awarded_provider_job_filter" action="my-awarded-job" method="post">
			{{csrf_field()}}
				<select id="awarded_job_filter" name="job_filter" class="form-control newAdd">					
					<option @if(Request::input('job_filter')=='') selected @endif value="">All</option>
					<option @if(Request::input('job_filter')=='this week') selected @endif value="this week">This week </option>
					<option @if(Request::input('job_filter')=='last week') selected @endif value="last week">Last week </option>
					<option @if(Request::input('job_filter')=='last month') selected @endif value="last month">Last month </option>
				</select>
			</form>
			<!--<i class="fa fa-sort-desc arx"></i>--> 
		</div>
	</div>
	<div class="contain_divs">
		<div class="container">
		 @if(count($provider_job_invitation))
			@foreach($provider_job_invitation as $jobs)
				<div class="col-sm-6 col-lg-6 col-md-6">
					<div class="awaded_jobs_block">
						<h3>{{ $jobs->categoryDetails->category->category_name}}</h3>
						<div class="clearfix"></div>
						<div class="awaded_type">
							<ul>
								<li><img src="images/ico03.png">Job Category : {{ $jobs->categoryDetails->category->category_name}}</li>
								<li><img src="images/ico04.png">Type : {{$jobs->providerJobDetails[0]->jobType->job_type_name}}</li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="awaded_des">
							<p>{{str_limit($jobs->providerJobDetails[0]->job_details,100)}}</p>
						</div>
						<div class="clearfix"></div>
						<div class="mob_block">
							<div class="time_2_contact">Time To Contact: <span>10:00 - 13:00</span></div>
							<div class="mmob"> 
							<a class="tooltips" href="#">
							<p>Mobile : {{$jobs->providerJobDetails[0]->users->mobile}} <span>Click + to View Full Mobile Number</span> </p></a> 
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="awarded_btn_group">
							@if($jobs->invitation_status==2)
								<div class="bbtn_lleft_p mark_as_complete">
								  <button type="button" class="btn btn-primary mark_com"  data-id="{{$jobs->job_invitation_id}}" data-target="#mark_complete">Mark Complete</button>
								</div>
							@elseif($jobs->invitation_status==3)
								<div class="bbtn_lleft_p">
								  <button type="button" class="btn btn-primary mark_com1" data-id="{{$jobs->job_invitation_id}}" data-toggle="modal" data-target="#request_feed">Request Feedback</button>
								</div>  
							@endif
							@if($jobs->invitation_status==2)
								<div class="in_progress_right">
									<p><span><img src="images/progress.png" ></span>In Progress</p>
								</div>
							@elseif($jobs->invitation_status==3)
								<div class="com">
									<p><span><img src="images/com.png" ></span>Completed</p>
								</div>
							@endif
						</div>
						<div class="clearfix"></div>
						<div class="bottom_footer_bbox">
							<ul>
								<li class="lloc"><img src="images/loc.png" style="float:left">			  
									<div class="mmob">
										<a class="tooltips" href="#">
										<p>{{str_limit($jobs->providerJobDetails[0]->city,5)}}
										<span>{{$jobs->providerJobDetails[0]->city}}</span></p>
										</a>
									</div>
								</li>
								<li  class="lloc_1"><span><img src="images/ttags.png" ></span>${{$jobs->price}}</li>
								<li class="lloc_2"><span><img src="images/ccal.png" ></span>Deadline: {{ Carbon\Carbon::parse($jobs->providerJobDetails[0]->deadline)->format('D j-M Y') }}</li>
							</ul>
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="norecordfound"><p>No awarded job found.</p></div>
		@endif
		</div>
	</div>
</div>
<!-- Modal -->
<div id="mark_complete" class="modal fade" role="dialog">
	<div class="modal-dialog"> 
	<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> </button>
				<h4 class="modal-title">Mark Completed </h4>
			</div>
			<div class="modal-body marks_completed NopaddB">
				<form action="provider-mark-complete-job" method="post" id="provider-mark-complete-job">
				{{csrf_field()}}
					<h3><i class="fa fa-check-circle" aria-hidden="true"></i>
					<span>The job is marked as completed and costomers are notified</span></h3>
					<input type="hidden" name="invitation_id" id="invitation_id">
					<div class="form-group">				  
					  <textarea class="form-control" rows="5" name="request_feedback" id="comment"></textarea>
					</div>
					<button type="submit" class="btn btn-primary mark_com">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
	<div class="modal-dialog"> 
	<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> </button>
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
<div id="request_feed" class="modal fade " role="dialog">
	<div class="modal-dialog"> 
	<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> </button>
				<h4 class="modal-title">Request Feedback</h4>
			</div>
			<div class="modal-body request_feed_msg">
				<h3><i class="fa fa-commenting-o" aria-hidden="true"></i> Your feedback request is send to the customer. </h3>
			<form action="request-feedback" method="post" id="request-feedback">
			 {{csrf_field()}}
			   <input type="hidden" name="invitation_master_id" id="invitation_master_id" value="">
				<div class="form-group">				  
				  <textarea class="form-control" rows="5" name="request_feedback" id="comment"></textarea>
				</div>
				<button type="submit" class="btn btn-primary mark_com">Submit</button>
			</form>
			</div>
		</div>
	</div>
</div>
@include('layout.builder_footer')
<script>
$(document).ready(function() {
   $('.mark_as_complete .mark_com').click(function(){
		$('#mark_complete').modal('show');   
	}); 
});
$("#awarded_job_filter").change(function(){
	$(this).closest('form').submit();
});
$('#provider-mark-complete-job').validate();
$('#request-feedback').validate();
</script> 
<script>
	$('[data-id]').click(function(){
		var id=$(this).attr('data-id');
		//var modal_title=$(this).attr('data-modal-title');
		//$('.modal-title').text('Reply for '+modal_title);
		$('#invitation_id').val(id);
	});
$("button:contains('Request Feedback')").click(function(){
	var id=$(this).attr('data-id');
	$("#invitation_master_id").val(id);
});
</script>
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