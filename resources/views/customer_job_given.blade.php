@extends('layout.app')
@section('title','My Given Jobs')
@section('body')
@include('layout.customer_header')
<div class="row Nomarg">
	<div class="contain_divs">
		<div class="container">
			@if(!$job_given->isEmpty())
				@foreach($job_given as $job)
					<div class="col-sm-6 col-lg-6 col-md-6 col-xs-12 W100">
						<div class="awaded_jobs_block user_pos">
							<h3>{{@$job->looking_for}}</h3>
							<!--<div class="edt"> <a href="#"><img src="images/edit.png" alt=""></a> <a href="#"><img src="images/ext.png" alt=""></a> </div>-->
							<div class="clearfix"></div>
							<div class="builder_namess_area"></div>
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
							<div class="jobs_given_block">
								<div class="col-sm-4 col-lg-2 col-md-3 col-xs-3 W100">
									@if(@$job->prof_image)
										<img class="img-responsive img-circle iimff" src="{{url('public/prof_image/'.$job->prof_image)}}" alt="">
									@else
										<img class="img-responsive img-circle iimff" src="images/noimages.png" alt="">
									@endif
								</div>
								<div class="col-sm-8 col-lg-10 col-md-9 col-xs-9 W100 nnpadd">
									<h3 class="pull-left nopadss">{{$job->user_name}}</h3>
									@if($job->invitation_status == 3)
										<button type="button" class="btn btn-primary mark_com pull-right MargL15 review" data-id="{{$job->job_id}}" data-builder_id="{{$job->to_user_id}}">Post Review</button>
									@endif
									<div class="clearfix"></div>
									@if($job->invitation_status == 3)
									<div class="com pull-left pppl">
										<p><span><img src="images/com.png"></span>Completed</p>
									</div>
									@else
										<div class="com1 pull-left ppp2">
											 <p><span><img src="images/progress.png"></span>In Progress</p>
										</div>
									@endif
									@if($job->invitation_status == 3)
										<div class="rreport_builders pull-right1 pppl">
											<a href="#"><span><img src="images/report.png"></span>Report a Builder</a>
										</div>
									@else
										<div class="rreport_builders pull-right1 ppp2">
											<a href="#"><span><img src="images/report.png"></span>Report a Builder</a>
										</div>
									@endif
								</div>
							</div>
						  <div class="clearfix"></div>
							<div class="bottom_footer_bbox">
								<ul>
									<li class="lloc"><span><img src="images/loc.png" ></span>{{@$job->city}}</li>
									<li class="lloc_2"><span><img src="images/ccal.png" ></span>Deadline: {{date('d F Y',strtotime($job->deadline))}}</li>
								</ul>
							</div>
						</div>
					</div>
				@endforeach
				@else
					<div class="norecordfound">
					<p>No Jobs Given Found.</p>
					</div>
			@endif
		</div>
	</div>
</div>
<div id="myModal7" class="modal fade " role="dialog">
	<div class="modal-dialog">
		<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title">Review</h4>
			</div>
			<div class="modal-body review_modal_body1">
				<form action="review-post" method="post" id="review_post">
					{{csrf_field()}}
					<div class="col-sm-12 col-lg-12 col-md-12 popad">
						<div class="form-group">
							<label class="control-label pop_label" for="pwd">Review Comments</label>
							<input class="form-control pop_type" placeholder="Type your comments here..." type="text" name="rev_comment" id="rev_comment">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="review_bblockss">
						<div class="col-sm-6 col-lg-4 col-md-6 col-xs-4 ">
							<div class="review_sub">Quality</div>
						</div>
						<div class="col-sm-6 col-lg-8 col-md-6 col-xs-8 no_pd_l">
							<div class="review_sub">
								<ul>
									<li><img class="quality" data-id="1" id="quality_re1" src="images/sstar_1.png"></li>
									<li><img class="quality" data-id="2" id="quality_re2" src="images/sstar_1.png"></li>
									<li><img class="quality" data-id="3" id="quality_re3" src="images/sstar_1.png"></li>
									<li><img class="quality" data-id="4" id="quality_re4" src="images/sstar_1.png"></li>
									<li><img class="quality" data-id="5" id="quality_re5" src="images/sstar_1.png"></li>
								</ul>
								<input type="hidden" name="quality_rating" id="quality_rating"/>
							</div>
						</div>
					</div>
					<div class="review_bblockss">
						<div class="col-sm-6 col-lg-4 col-md-6 col-xs-4">
							<div class="review_sub">On-Time</div>
						</div>
						<div class="col-sm-6 col-lg-8 col-md-6 col-xs-8 no_pd_l">
							<div class="review_sub">
								<ul>
									<li><img class="time" data-id="1" id="time_re1" src="images/sstar_1.png"></li>
									<li><img class="time" data-id="2" id="time_re2" src="images/sstar_1.png"></li>
									<li><img class="time" data-id="3" id="time_re3" src="images/sstar_1.png"></li>
									<li><img class="time" data-id="4" id="time_re4" src="images/sstar_1.png"></li>
									<li><img class="time" data-id="5" id="time_re5" src="images/sstar_1.png"></li>
								</ul>
								<input type="hidden" name="time_rating" id="time_rating"/>
							</div>
						</div>
					</div>
					<div class="review_bblockss">
						<div class="col-sm-6 col-lg-4 col-md-6 col-xs-4">
							<div class="review_sub">Price</div>
						</div>
						<div class="col-sm-6 col-lg-8 col-md-6 col-xs-8 no_pd_l">
							<div class="review_sub">
								<ul>
									<li><img class="price" data-id="1" id="price_re1" src="images/sstar_1.png"></li>
									<li><img class="price" data-id="2" id="price_re2" src="images/sstar_1.png"></li>
									<li><img class="price" data-id="3" id="price_re3" src="images/sstar_1.png"></li>
									<li><img class="price" data-id="4" id="price_re4" src="images/sstar_1.png"></li>
									<li><img class="price" data-id="5" id="price_re5" src="images/sstar_1.png"></li>
								</ul>
								<input type="hidden" name="price_rating" id="price_rating"/>
							</div>
						</div>
					</div>
					<div class="review_bblockss">
						<div class="col-sm-6 col-lg-4 col-md-6 col-xs-4">
							<div class="review_sub">We Hire Again</div>
						</div>
						<div class="col-sm-6 col-lg-8 col-md-6 col-xs-8 no_pd_l">
							<div class="review_sub">
								<ul>
									<li><img class="hire" data-id="1" id="hire_re1" src="images/sstar_1.png"></li>
									<li><img class="hire" data-id="2" id="hire_re2" src="images/sstar_1.png"></li>
									<li><img class="hire" data-id="3" id="hire_re3" src="images/sstar_1.png"></li>
									<li><img class="hire" data-id="4" id="hire_re4" src="images/sstar_1.png"></li>
									<li><img class="hire" data-id="5" id="hire_re5" src="images/sstar_1.png"></li>
								</ul>
								<input type="hidden" name="hire_rating" id="hire_rating"/>
							</div>
						</div>
					</div>
					<div class="review_bblockss">
						<div class="col-sm-6 col-lg-4 col-md-6 col-xs-4">
							<div class="review_sub">Recomm</div>
						</div>
						<div class="col-sm-6 col-lg-8 col-md-6 col-xs-8 no_pd_l">
							<div class="review_sub">
								<ul>
									<li><img class="recomm" data-id="1" id="recomm_re1" src="images/sstar_1.png"></li>
									<li><img class="recomm" data-id="2" id="recomm_re2" src="images/sstar_1.png"></li>
									<li><img class="recomm" data-id="3" id="recomm_re3" src="images/sstar_1.png"></li>
									<li><img class="recomm" data-id="4" id="recomm_re4" src="images/sstar_1.png"></li>
									<li><img class="recomm" data-id="5" id="recomm_re5" src="images/sstar_1.png"></li>
								</ul>
								<input type="hidden" name="recomm_rating" id="recomm_rating"/>
							</div>
						</div>
					</div>
					<input type="hidden" name="job_id" id="job_id"/>
					<input type="hidden" name="builder_id" id="builder_id"/>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<button type="submit" class="btn btn-primary mark_com pull-right MargT30 post_bbttn ">SUBMIT REVIEW</button>
						<span class="span_erro1"></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>  
@include('layout.customer_footer')
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<style>
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
	$('#review_post').submit(function(){
		if($('#rev_comment').val() == "")
		{
			$('.span_erro1').html('Write some comment for this builder');
			return false;
		}
		else if($('input:hidden[name=rev_comment]').val() == "")
		{
			$('.span_erro1').html('Give review for quality');
			return false;
		}
		else if($('#time_rating').val() == "")
		{
			$('.span_erro1').html('Give review for on-time');
			return false;
		}
		else if($('#price_rating').val() == "")
		{
			$('.span_erro1').html('Give review for price');
			return false;
		}
		else if($('#hire_rating').val() == "")
		{
			$('.span_erro1').html('Give review for we hire again');
			return false;
		}
		else if($('#recomm_rating').val() == "")
		{
			$('.span_erro1').html('Give review for recomm');
			return false;
		}
		else
		{
			return true;
		}
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
	$(".quality").click(function(){
		var quality = $(this).data('id');
		$(".quality").attr("src","images/sstar.png");
		$(".quality").attr("src","images/sstar_1.png");
		for(var i=0;i<=quality;i++)
		{
			//alert(i);
			$("#quality_re"+i).attr("src","images/sstar_1.png");
			$("#quality_re"+i).attr("src","images/sstar.png");
		}
		$("#quality_rating").val(quality);
	});
	$(".time").click(function(){
		var time = $(this).data('id');
		$(".time").attr("src","images/sstar.png");
		$(".time").attr("src","images/sstar_1.png");
		for(var i=0;i<=time;i++)
		{
			//alert(i);
			$("#time_re"+i).attr("src","images/sstar_1.png");
			$("#time_re"+i).attr("src","images/sstar.png");
		}
		$("#time_rating").val(time);
	});
	$(".price").click(function(){
		var price = $(this).data('id');
		$(".price").attr("src","images/sstar.png");
		$(".price").attr("src","images/sstar_1.png");
		for(var i=0;i<=price;i++)
		{
			//alert(i);
			$("#price_re"+i).attr("src","images/sstar_1.png");
			$("#price_re"+i).attr("src","images/sstar.png");
		}
		$("#price_rating").val(price);
	});
	$(".hire").click(function(){
		var hire = $(this).data('id');
		$(".hire").attr("src","images/sstar.png");
		$(".hire").attr("src","images/sstar_1.png");
		for(var i=0;i<=hire;i++)
		{
			//alert(i);
			$("#hire_re"+i).attr("src","images/sstar_1.png");
			$("#hire_re"+i).attr("src","images/sstar.png");
		}
		$("#hire_rating").val(hire);
	});
	$(".recomm").click(function(){
		var recomm = $(this).data('id');
		$(".recomm").attr("src","images/sstar.png");
		$(".recomm").attr("src","images/sstar_1.png");
		for(var i=0;i<=recomm;i++)
		{
			//alert(i);
			$("#recomm_re"+i).attr("src","images/sstar_1.png");
			$("#recomm_re"+i).attr("src","images/sstar.png");
		}
		$("#recomm_rating").val(recomm);
	});
	$('.review').click(function(){
		$('#job_id').val($(this).data('id'));
		$('#builder_id').val($(this).data('builder_id'));
		$('#myModal7').modal("show");
	});
});
$(function() {
var showTotalChar = 160, showChar = "", hideChar = "";
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