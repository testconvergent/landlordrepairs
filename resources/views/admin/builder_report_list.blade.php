@extends('admin.layout.app')
@section('title','Builder Report')
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
                                <h4 class="pull-left page-title">Builder Report List</h4>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
									@if(@session()->get('success'))
										<div class="alert alert-success ">{{session()->get('success')}}</div>
									@endif
									@if(@session()->get('info'))
										<div class="alert alert-info ">{{session()->get('info')}}</div>
									@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 12px 11px 17px 0px;">
												<span class="legrn">Legend : </span>
												<i class="fa fa-eye cncl" aria-hidden="true" style="border-right:none;"> <span class="cncl_oopo">= View</span></i>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Customer Name</th>
																<th>Builder Name</th>
																<th>Job title</th>
																<th>Report Title</th>
																<th>Report Date</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(count($report))
															@foreach($report as $row)
																<tr>
																	<td>{{@$row->customer_name}}
																	</td>
																	<td>
																	{{@$row->builder_name}}
																	</td>
																	<td>
																	{{@$row->looking_for}}
																	</td>
																	<td>{{@$row->report_title}}</td>
																	<td>{{date('d-m-Y',strtotime(@$row->report_date))}}</td>
																	<td>
																	<a href="admin-builder-report-details/{{$row->report_id}}" title="View"> <i class="fa fa-eye delet" aria-hidden="true"></i></a>
																	</td>
																</tr>
																@endforeach
																@else
																	<tr><td colspan="6">No Report Found.</td></tr>
															@endif
														</tbody>
													</table>
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