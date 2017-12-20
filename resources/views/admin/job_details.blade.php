@extends('admin.layout.app')
@section('title','Customer Details')
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
                                <h4 class="pull-left page-title">Job Details</h4>
								<div class="submit-login pull-right">
									<a href="admin-posted-job-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
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
													<p>Customer details</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Name</strong>: {{@$job_details->job->users->user_name}} </label>
												</div>
											</div>
											<div class="col-md-8 col-sm-8 col-xs-12 col-lg-8">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Email </strong>: {{@$job_details->job->users->email}} </label>
												</div>
											</div>
											<div class="col-md-8 col-sm-8 col-xs-12 col-lg-8">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Phone </strong>: {{@$job_details->job->users->mobile}} </label>
												</div>
											</div>											
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Job category</strong>: {{@$job_details->category->category_name}} </label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Job description</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Job title</strong>: {{@$job_details->job->looking_for}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Budget</strong>: £ {{@$job_details->job->budget}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Deadline</strong>: {{ Carbon\Carbon::parse($job_details->job->deadline)->format('D j-M Y') }}  </label>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Job details</strong> : {{ $job_details->job->job_details}}</label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Job location</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>City</strong>: {{@$job_details->job->city}}  </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>zip code</strong>: {{ $job_details->job->zip_code }}  </label>
												</div>
											</div>
											
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Bid description</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Total bids</strong>: {{ $job_details->job->no_of_bids }}  </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Average bid</strong>: {{ $job_details->job->avg_bid }}  </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Expiry date</strong>: {{ Carbon\Carbon::parse($job_details->job->exp_date)->format('D j-M Y h:isa') }}  </label>
												</div>
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
@endsection   