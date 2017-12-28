@extends('layout.app') 
@section('title','My Profile') @section('body')
<!--wrapper start-->
<div class="row Nomarg">
    @include('layout.provider_header')
</div>
<div class="row Nomarg" >
	<div class="contain_divs">
		<div class="container">
			@if(count($provider_job_invitation) && count($provider_job_invitation[0]->providerJobDetails)>0)
				@foreach($provider_job_invitation as $jobs)					
				<div class="col-sm-6 col-lg-6 col-md-6">
					<div class="awaded_jobs_block">	
						<h3>{{ $jobs->providerJobDetails[0]->looking_for}}</h3>
						<div class="clearfix"></div>
						<div class="awaded_type">
							<ul>
								<li><img src="images/ico03.png">Job Category :{{ $jobs->providerJobDetails[0]->jobToCategory->category->category_name}}</li>		
								<li><img src="images/ico04.png">Type : {{$jobs->providerJobDetails[0]->jobType->job_type_name}}</li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="awaded_des">
							<div class="job_desription">
							<p>{{$jobs->providerJobDetails[0]->job_details}}</p>
							@if(count($jobs->jobAttachment))							
							<div class="attac_area" id="attach_file_1">
							@foreach($jobs->jobAttachment as $attachment)
							<a href="{{url('/attachment/'.$attachment->attachment_name)}}" download="{{$attachment->orginal_name}}">{{$attachment->orginal_name}}</a>
							@endforeach
							</div>							
							@endif
							</div>
							<a class="read_more" style="display:none;" href="javascript:void(0)">Read more</a>
							<a class="less_more" style="display:none;" href="javascript:void(0)">Less more</a>
						</div>
						<div class="clearfix"></div>
						<div class="mob_block">
							<div class="time_2_contact">Time To Contact: <span>10:00 - 13:00</span></div>
							<div class="mmob">
								<a class="tooltips" href="#">
									<p>Mobile : {{$jobs->providerJobDetails[0]->users->mobile}}
									<span>Click + to View Full Mobile Number</span> </p>
								</a>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="awarded_btn_group">
							<div class="bbtn_lleft_p">
							@if($jobs->invitation_status==0 && $jobs->providerJobDetails[0]->exp_date>=date('Y-m-d H:i:s'))
								<button type="button" data-toggle="modal" data-modal-title="{{ $jobs->providerJobDetails[0]->looking_for}}" data-id="{{$jobs->job_invitation_id}}" data-target="#myModal1" class="btn btn-primary respondent">Respond</button>
							@elseif($jobs->invitation_status==1)
								<div class="repondeded"><i class="fa fa-check-circle" aria-hidden="true"></i> Responded</div>
							@endif 
							</div>
							<div class="mail_msg">
							@if($jobs->invitation_status==0)
									@if($jobs->providerJobDetails[0]->exp_date>=date('Y-m-d H:i:s'))
									<p><img src="images/mails.png"><span>you have been invited </span></p>
									@else
									<p><img src="images/mails.png"><span>This job has been expired.</span></p>	
									@endif
							@elseif($jobs->invitation_status==1)
								<p><img src="images/mails.png"><span>waiting for customer response </span></p>
							@endif
							</div>
							<div class="mail_msg">
							@if($jobs->invitation_status==4)
								<p><img src="images/mails.png"><span>Your request for bid has been rejected</span></p>
							@elseif($jobs->invitation_status==4)
								<p><img src="images/mails.png"><span>waiting for customer response </span></p>
							@endif
							</div>
						</div>	
						<div class="clearfix"></div>
						<div class="bottom_footer_bbox">
							<ul>
								<li class="lloc">
								 <img src="images/loc.png" style="float:left">				
								 <div class="mmob">
								 <a class="tooltips" href="#">
									<p>{{str_limit($jobs->providerJobDetails[0]->city,5)}}
									<span>{{$jobs->providerJobDetails[0]->city}}</span> 
										
									</p>
								 </a>
								</div>
								</li>
								<li class="lloc_1">
								<span><img src="images/ttags.png" ></span>
								${{$jobs->providerJobDetails[0]->budget}}
								</li>
								<li class="lloc_2">
								<span><img src="images/ccal.png" >
								</span>Deadline: {{ Carbon\Carbon::parse($jobs->providerJobDetails[0]->deadline)->format('d F Y') }}
								</li>				
							</ul>
						</div>
					</div>
				</div>				
				@if($loop->iteration%2==0)
						<div class="clear"></div>
				@endif
				@endforeach
				@else
					<div class="norecordfound"><p>No invited job found.</p></div>
			@endif
		</div>
	</div>
</div>
@include('layout.builder_footer')
<script>
	$('[data-id]').click(function(){
		var id=$(this).attr('data-id');
		var modal_title=$(this).attr('data-modal-title');
		$('.modal-title').text('Reply for '+modal_title);
		$('#invitation_id').val(id);
	});
</script>
<!--wrapper end-->
</div>
<div id="myModal1" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
				</button>
				<h4 class="modal-title">Response</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB">
				<form class="modal_form_rreview" id="submit_quote" action="provider-quote-submit" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
						<input type="hidden" name="invitation_id" id="invitation_id">
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Price</label>
							<input type="text" class="form-control required" name="price" placeholder="Price" onkeypress="validate(event)">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Start Date</label>
							<div class="ccal">
								<img src="images/call.png">
								<input type="text" class="form-control required" placeholder="Start date" name="start_date" id="datepicker" readonly style="background-color: #fff;">
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control required" name="quote_description" rows="3" id="comment"></textarea>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<div class="Uploadbtn">
								<input type="file" id="quote_attachment" name="quote_attachment" class="input-upload" />
								<span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
							</div>
						</div>
						<div class="file_name"></div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<button type="submit" class="btn btn-primary mark_com pull-right MargT30 post_bbttn">Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$('#submit_quote').validate();
$('.read_more').click(function(){
     $(this).hide();
	$('.job_desription').css("height",'auto');
	$('.job_desription').css('-webkit-line-clamp','');
   $('.job_desription').css('display','block');	
     $('.less_more').show();	
 });
$('.less_more').click(function(){
     $(this).hide();
	 $('.job_desription').css("height",'67px');
	 $('.job_desription').css('-webkit-line-clamp','3');
	 $('.job_desription').css('display','-webkit-box');
     $('.read_more').show();
});
$(document).ready(function(){
if($('.job_desription').height()>50){
$('.read_more').show();
$('.job_desription').css('height','67px');
$('.job_desription').css('overflow','hidden');
$('.job_desription').css('display','-webkit-box');
$('.job_desription').css('-webkit-line-clamp','3');
$('.job_desription').css('-webkit-box-orient','vertical');
}
});

$("#quote_attachment").change(function(){		
		if (this.files && this.files[0]) {
           $('.file_name').html(this.files[0].name);
       }
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