@extends('admin.layout.app')
@section('title','Tradesmen Details')
@section('body')
    <div id="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.nav')                    
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Tradesmen Details</h4>
								<div class="submit-login pull-right">
									<a href="admin-tradesmen-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Personal Information</p>
												</div>
											</div>
											<?php
											$title=array(
											1=>'Mr. ',
											2=>'Mrs. ',
											3=>'Ms. '
											);
											?>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Name</strong>: {{$title[$user->sur_name]}}{{@$user->user_name}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Email</strong>: {{@$user->email}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Mobile Number</strong>: {{@$user->mobile}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Category</strong>: {{@$user->category_name}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Business Type</strong>: @if(@$user->business_type == 1)Partner @else Provider @endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Post Code</strong>: {{@$user->post_code}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Address</strong>: {{@$user->address}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Years in Biz</strong>: {{@$user->year_in_biz}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Qualification</strong>: {{@$user->qualification}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Qualification</strong>: {{@$user->qualification}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Emergency Job</strong>: @if(@$user->emergency_job == 1)Yes @else No @endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Insurance</strong>: @if(@$user->insurance == 1)Yes @else No @endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Team</strong>: {{@$user->team_members}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Working Hours</strong>: {{@$user->working_hours}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Status</strong>: 
													@if($user->is_email_verified == 0 && $user->user_status == 0){{'Email Not Verified'}}
													
													@elseif($user->is_phone_verified == 0 && $user->user_status == 0){{'Phone Number Not Verified'}}
													
													@elseif($user->is_email_verified == 1 && $user->user_status == 1){{'Active'}}
													
													@elseif($user->is_email_verified == 1 && $user->user_status == 2){{'Inactive'}}
													@endif
													</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Registration Date</strong>:
													@if(@$user->registration_date)
													{{date('d-m-Y'),strtotime(@$user->registration_date)}} @endif</label>
												</div>
											</div>
												<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
													
													@if(@$user->prof_image)
													<img src="{{asset('public/prof_image/'.$user->prof_image)}}" class="img-ppic" width="229" height="223">	
													@else
													<img src="{{asset('public/prof_image/no_image_available.png')}}" class="img-ppic" width="229" height="223">	
													@endif
																				
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Profile Description</p>
												</div>
											</div>
											<style>
											.abc{
												width: 10%;
												overflow: hidden;
												position: relative;
												text-align: center;
												height: 145px;
												background: #ccc;
											}
											</style>
										
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Profile Title</strong>: {{@$user->prof_title}} </label>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Profile Description</strong>: {{@$user->prof_description}} </label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Portfolio</p>
												</div>
												@if(!$portfolio->isEmpty())
													@foreach($portfolio as $port)
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
														<h3 class="bbfore">Before</h3>
														<div class="view1">
															<img src="{{url('public/portpolio_normal/'.$port->before_image)}}" />
														</div>
														</div>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
														<h3 class="bbfore">After</h3> 
														<div class="view1">
															
															<img src="{{url('public/portpolio_normal/'.$port->after_image)}}" />
														</div>
														</div>
													@endforeach
												@endif
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Logo</p>
												</div>
												@if(!$logo->isEmpty())
													@foreach($logo as $logo)
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
														<div class="logo_image">
															<img src="{{url('public/logo_image/'.$logo->logo_image)}}" />
														</div>
														</div>
													@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div><!-- End Row -->
                    </div> <!-- container -->       
                </div> <!-- content -->
            </div>
        </div>
		<style>
		.view1 {
		float: left;
		width: 100%;
		overflow: hidden;
		position: relative;
		text-align: center;
		height: 170px;
		background: #ccc;
		}
		.view1 img {
		max-width: 100%;
		position: absolute;
		margin: auto;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		}
		.logo_image
		{
		height: 85px;
		overflow: hidden;
		position: relative;
		background: #ccc;
		 display: inline-block;
		float: left;
		border: 1px solid #ddd;
		width: 100%;
		    margin-bottom: 15px;
		float: left;
		}
		.logo_image img
		{
			position: absolute;
			margin: auto;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			max-width: 100%;
			max-height: 100%;
		}
		</style>
@endsection   