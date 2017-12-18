@extends('admin.layout.app')
<?php if(Request::segment(1) == "admin-add-category"){?>
@section('title','Add Category')
<?php } 
if(Request::segment(1) == "admin-category-list"){?>
@section('title','Category')
<?php } 
if(Request::segment(1) == "admin-edit-category" && Request::segment(2) != ""){?>
@section('title','Edit Category')
<?php } ?>
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
								<?php if(Request::segment(1) == "admin-add-category"){?>
                                <h4 class="pull-left page-title">Add Category</h4>
								<?php
								}
								if(Request::segment(1) == "admin-edit-category" && Request::segment(2) != ""){?>
								<h4 class="pull-left page-title">Edit Category</h4>
								<?php
								}
								if(Request::segment(1) == "admin-category-list"){?>
								<h4 class="pull-left page-title">Category List</h4>
								<?php
								}
								?>
								<div class="submit-login pull-right">
									<?php if(Request::segment(1) == "admin-category-list"){?>
									<a href="admin-add-category"><button type="submit" class="btn btn-default tpp">Add Category</button></a>
									<?php
									}
									else
									{
									?>
									<a href="admin-category-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
									<?php
									}
									?>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body table-rep-plugin <?php if(Request::segment(1) == "admin-category-list"){?>pdd<?php } ?>">
                                        <div class="row">
                                            <div class="clearfix"></div>
											<?php if(Request::segment(1) == "admin-add-category"){?>
											<form method="post" id="add_cat" action="admin-add-category" enctype="multipart/form-data">
												{{csrf_field()}}
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1"> Category</label>
														<input class="form-control required" id="exampleInputEmail1" type="text" name="category_name">
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
													<div class="add_btnm">
														<input value="Add" type="submit">
													</div>
												</div>
											</form>
											<?php } 
											if(Request::segment(1) == "admin-edit-category" && Request::segment(2) != ""){?>
											<form method="post" id="add_cat" action="admin-edit-category/{{$fetch_row->category_id}}" enctype="multipart/form-data">
												{{csrf_field()}}
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1"> Category</label>
														<input class="form-control required" id="exampleInputEmail1" type="text" name="category_name" value="{{@$fetch_row->category_name}}">
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
													<div class="add_btnm">
														<input value="Update" type="submit">
													</div>
												</div>
											</form>
											<?php } ?>
										</div>
									</div>
								</div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
									@if(@session()->get('success'))<div class="alert alert-success ">{{session()->get('success')}}</div>@endif
									@if($errors->has('category_image'))<div class="alert alert-danger">{{$errors->first('category_image')}}</div>@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
                                            <div class="clearfix"></div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 12px 11px 17px 0px;">
												<span class="legrn">Legend : </span>
												<i class="fa fa-pencil-square-o cncl" aria-hidden="true"> <span class="cncl_oopo">= Edit</span></i>
												<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true" style="border-right:none;"> <span class="cncl_oopo">= Inactive</span></i>
												<i class="fa fa-trash cncl" aria-hidden="true" style="border-right:none;"> <span class="cncl_oopo">= Delete</span></i>
											</div> 
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Category</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(!$category->isEmpty())
															@foreach($category as $row)
																<tr>
																	<td>
																	{{@$row->category_name}}
																	</td>
																	<td>@if($row->category_status == 1)Active
																	@elseif($row->category_status == 0)Inactive
																	@endif</td>
																	<td>
																		<a href="admin-edit-category/{{$row->category_id}}" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
																		@if($row->category_status == 1)
																		<a href="admin-category-status/{{$row->category_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times cncl1" aria-hidden="true"></i></a>
																		@elseif($row->category_status == 0)
																		<a href="admin-category-status/{{$row->category_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check delet" aria-hidden="true"></i></a>
																		@endif
																		<a href="admin-category-delete/{{$row->category_id}}" onclick="return confirm('Are you want to delete this category ?')" title="Delete"><i class="fa fa-trash delet	" aria-hidden="true"></i></a>
																	</td>
																</tr>
																@endforeach
																@else
																	<tr><td colspan="3">No Record Found</td></tr>
															@endif
														</tbody>
													</table>
													{{$category->links()}}
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
		<script>
		$(document).ready(function(){
			$('#add_cat').validate();
		});
		</script>
@endsection   