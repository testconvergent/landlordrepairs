@extends('admin.layout.app')
@section('title','Static Page List')
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
                                <h4 class="pull-left page-title">Static Page List</h4>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
									@if(@session()->get('success'))
										<div class="alert alert-success">{{session()->get('success')}}</div>
									@endif
									@if(@session()->get('info'))
										<div class="alert alert-info">{{session()->get('info')}}</div>
									@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 12px 11px 17px 0px;">
												<span class="legrn">Legend : </span>
												<i style="border-right:none;" class="fa fa-pencil-square-o cncl" aria-hidden="true"> <span class="cncl_oopo">= Edit</span></i>
												<!--<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true" style="border-right:none;"> <span class="cncl_oopo">= Inactive</span></i>-->
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th style="min-width: 143px;">Page Title</th>
																<th>Description</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(count($page))
															@foreach($page as $row)
																<tr>
																	<td>
																	{{$row->page_title}}
																	</td>
																	<td>
																	{{strip_tags(str_limit($row->page_description,150))}}
																	</td>
																	<td>
																	<a href="admin-edit-static-page/{{$row->page_id}}" title="View"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
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