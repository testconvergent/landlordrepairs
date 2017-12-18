@extends('admin.layout.app')
@section('title','Package')
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
                                <h4 class="pull-left page-title">Package List</h4>
								<!--<div class="submit-login pull-right">
									<a href="admin-add-package"><button type="submit" class="btn btn-default tpp">Add Package</button></a>
								</div>-->
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
											<form method="post"  action="admin-posted-job-list">
												{{csrf_field()}}
												<div class="admin_search_area">
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">													
														<label for="exampleInputEmail1">Category</label>														
														<select class="form-control newdrop" name="category_id">
															<option value="">All</option>
															@foreach($category_details as $row )
															<option value="{{$row->category_id}}" @if(Request::input('category_id') == $row->category_id){{'selected'}}@endif>{{$row->category_name}}</option>
															@endforeach
														</select>
														
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Keyword</label>
														<input class="form-control" id="exampleInputEmail1" type="text" placeholder="search with job title" name="keyword" value="{{Request::input('keyword')}}">
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="add_btnm">
														<input value="Search" type="submit">
													</div>
												</div>
												</div>
												</div>
											</form>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 12px 11px 17px 0px;">
												<span class="legrn">Legend : </span>
												<i class="fa fa-pencil-square-o cncl" aria-hidden="true"> <span class="cncl_oopo">= Edit</span></i>
												<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true" style="border-right:none;"> <span class="cncl_oopo">= Inactive</span></i>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<!--<th>
																<input type="checkbox" id="myCheckbox"/> <!-- Checked 
																</th>-->
																<th>Category</th>
																<th>User</th>
																<th>Job title</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(count($posted_job_details))
															@foreach($posted_job_details as $jobs)
																<tr>
																	<!--<td><input type="checkbox" name="user[]" value="{{@$row->user_id}}"/></td>
																	<td>-->
																	<td>
																	{{$jobs->category->category_name}}
																	</td>
																	<td>
																	{{$jobs->job->users->user_name}}
																	</td>
																	<td>
																	{{$jobs->job->looking_for}}
																	</td>
																	<?php
																	$status=array('0'=>'Active','1'=>'Active','2'=>'Inactive')																	
																	?>
																	<td>{{$status[$jobs->job->job_status]}}</td>
																	<td>
																	<a href="admin-view-job-details/{{$jobs->job->job_id}}" title="View"> <i class="fa fa-eye delet" aria-hidden="true"></i></a>
																		@if($jobs->job->job_status == 2)
																		<a href="admin-posted-job-status/{{$jobs->job->job_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check cncl1" aria-hidden="true"></i></a>
																		@elseif($jobs->job->job_status == 1)
																		<a href="admin-posted-job-status/{{$jobs->job->job_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times delet" aria-hidden="true"></i></a>
																		@endif
																	</td>
																</tr>
																@endforeach
																@else
																	<tr><td colspan="5">No jobs found</td></tr>
															@endif
														</tbody>
													</table>
												</div>
												{{$posted_job_details->links()}}
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
		<script>
		$(document).ready(function(){
			$('#myCheckbox').click(function() {
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
			$('input:checkbox').click(function(){
			$('.multi_status_change_admin').hide();
		});
		$("#admin-change-multi-customer-status").submit(function(){			
			var status=false;
			$.each($('input:checkbox'),function(event){
				if($(this).prop('checked')){
					status=$(this).prop('checked');
					return false;
				}
			});			
			if(!status){$('.multi_status_change_admin').fadeIn('slow');return false;}
			else return true
		});
		});
		</script>
@endsection