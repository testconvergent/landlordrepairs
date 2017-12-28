@extends('admin.layout.app')
@section('title','Builder Report Details')
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
                                <h4 class="pull-left page-title">Builder Report Details</h4>
								<div class="submit-login pull-right">
									<a href="admin-builder-report-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
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
													<p>Customer Information</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Name</strong>: {{@$report->customer_name}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Email</strong>: {{@$report->customer_email}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Mobile Number</strong>: {{@$report->customer_mobile}} </label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Builder Information</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Name</strong>: {{@$report->builder_name}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Email</strong>: {{@$report->builder_email}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Phone Number</strong>: {{@$report->builder_mobile}} </label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Report Details</p>
												</div>
											</div>
											<div class="col-md-9 col-sm-9 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Report Title</strong>: {{@$report->report_title}} </label>
												</div>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Date</strong>: {{date('d-m-Y',strtotime(@$report->report_date))}}</label>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Report Description</strong>: {{strip_tags(@$report->report_description)}} </label>
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