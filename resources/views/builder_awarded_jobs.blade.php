@extends('layout.app') 
@section('title','My Profile') 
@section('body')
<!--wrapper start-->
<div class="row Nomarg">
	@include('layout.provider_header')
		<div class="adnew1 serach_awrd">
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
	<div class="contain_divs">
		<div class="container">
		 @if(count($provider_job_invitation))
			@foreach($provider_job_invitation as $jobs)
				<div class="col-sm-6 col-lg-6 col-md-6">
					<div class="awaded_jobs_block">
						<h3>{{ $jobs->providerJobDetails[0]->looking_for}}</h3>
						<div class="clearfix"></div>
						<div class="awaded_type">
							<ul>
								<li><img src="images/ico03.png">Job Category : {{ $jobs->providerJobDetails[0]->jobToCategory->category->category_name}}</li>
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
							<a href="{{url('attachment/'.$attachment->attachment_name)}}" download="{{$attachment->orginal_name}}">{{$attachment->orginal_name}}</a>
							@endforeach
							</div>							
							@endif
							</div>
							<a class="read_more" style="display:none;" href="javascript:void(0)">Read more</a>
							<a class="less_more" style="display:none;" href="javascript:void(0)">Less more</a>
						</div>
						<div class="clearfix"></div>
						<div class="mob_block">
				<div class="time_2_contact">Time To Contact: <span>{{str_replace('-',' - ',$jobs->providerJobDetails[0]->users->working_hours)}}</span></div>
							<div class="mmob"> 
							<a class="tooltips" href="#">
							<p>Mobile : {{$jobs->providerJobDetails[0]->users->mobile}} <span>Click + to View Full Mobile Number</span> </p>
							</a> 
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="awarded_btn_group">
							@if($jobs->invitation_status==2)
								<div class="bbtn_lleft_p mark_as_complete">
								  <button type="button" class="btn btn-primary mark_com"  data-id="{{$jobs->job_invitation_id}}" data-target="#mark_complete">Mark Complete</button>
								</div>
							@elseif($jobs->invitation_status==3 && $jobs->is_review==0)
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
						@if($jobs->invitation_status==3 && $jobs->is_review==1)
							<style>
							.awarded_btn_group
							{ 	width: 50%;
								float:right;
							}
						    </style>
							<div class="review_tooltip">
							<div class="rreview">
								<ul>
								@php
								for($i=1;$i<=floor($jobs->jobReview->ave_review);$i++){
								@endphp
									<li><img src="images/sstar.png" alt=""></li>
								@php
								}								
								for($j=$i;$j<=5;$j++){
								@endphp
									<li><img src="images/sstar_1.png" alt=""></li>
								@php
								}
								@endphp
					            </ul>  
														
							</div>
							<!-- <span class="aveg_review_print">
							{{$jobs->jobReview->ave_review}}
							</span>	
							-->
							<div class="rating_deascription">
							<ul>
							<li>Quality<span>:{{$jobs->jobReview->quality}}</span></li>
							<li>On time<span>:{{$jobs->jobReview->on_time}}</span></li>
							<li>Price<span>:{{$jobs->jobReview->price}}</span></li>
							<li>Hire<span>:{{$jobs->jobReview->hire}}</span></li>
							<li>Recommendation<span>:{{$jobs->jobReview->recomm}}</span></li>
							</ul>							
							</div>
						</div>							
						@endif
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
								<li class="lloc_2"><span><img src="images/ccal.png" ></span>Deadline: {{ Carbon\Carbon::parse($jobs->providerJobDetails[0]->deadline)->format('d F Y') }}</li>
							</ul>
						</div>
					</div>
				</div>
				@if($loop->iteration%2==0)
						<div class="clear"></div>
					@endif
			@endforeach
		@else
			<div class="norecordfound"><p>No awarded job found.</p></div>
		@endif		
		</div>
	</div>
</div>
<!-- Modal -->
@component('modal.builder_awarded_mark_complete',['title'=>'Mark Completed '])
		Modal pop-up HTML of mark complete will be included.
@endcomponent

@component('modal.builder_awarded_request_feedback')
		 @slot('title')
			<h4 class="modal-title">Request Feedback</h4>
		 @endslot
		Modal pop-up HTML of request feedback will be included.
@endcomponent

@include('layout.builder_footer')
@push('mark_as_complete_modal_open')
    <script>
	$(document).ready(function() {
	$('.mark_as_complete .mark_com').click(function(){
		$('#mark_complete').modal('show');   
	}); 
	});
	</script>
@endpush
@push('awarded_job_filter_search_by_date')
    <script>
	$("#awarded_job_filter").change(function(){
		$(this).closest('form').submit();
	});
	</script>
@endpush
 @stack('awarded_job_filter_search_by_date')
 @stack('mark_as_complete_modal_open')
<script>
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
$('.review_tooltip').hover(function(){
$(this).find('.rating_deascription').show();
},function(){
$(this).find('.rating_deascription').hide();
});
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
</script>
@if(session()->get('success'))
@component('alert.sweet_alert')
	 @slot('message')
	 {{session()->get('success')}}
    @endslot
 Sweet alert message
@endcomponent
@endif 
@endsection