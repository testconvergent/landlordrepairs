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
								<div class="submit-login pull-right">
									<a href="admin-add-package"><button type="submit" class="btn btn-default tpp">Add Package</button></a>
								</div>
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
											<form method="post"  action="admin-customers-list">
												{{csrf_field()}}
												<div class="admin_search_area">
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Status</label>
														<select class="form-control newdrop" name="status">
															<option value="">All</option>
															<option value="1" @if(@$post_data['status'] == 1){{'selected'}}@endif>Active</option>
															<option value="2" @if(@$post_data['status'] == 2){{'selected'}}@endif>Inactive</option>
														</select>
														
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Keyword</label>
														<input class="form-control" id="exampleInputEmail1" type="text" name="keyword" value="{{@$post_data['keyword']}}">
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
											<!--<form id="admin-change-multi-customer-status" action="admin-change-multi-customer-status" method="post">
											{{csrf_field()}}
                                            <div class="clearfix"></div>
											<div class="col-md-5 col-lg-5">
												<div class="add_btnm1">
													<button class="btn btn-primary btn-md" value="Active" type="submit" name="action">Active</button>
													<button class="btn btn-primary btn-md" value="Inactive" type="submit" name="action">Inactive</button>
													<span class="multi_status_change_admin">Please check any record to submit.</span>
												</div>
											</div>-->
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 12px 11px 17px 0px;">
												<span class="legrn">Legend : </span>
												<i class="fa fa-eye cncl" aria-hidden="true"> <span class="cncl_oopo">= View</span></i>
												<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true"> <span class="cncl_oopo">= Inactive</span></i>
												<i class="fa fa-trash cncl" aria-hidden="true"> <span class="cncl_oopo">= Delete</span></i>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<!--<th>
																<input type="checkbox" id="myCheckbox"/> <!-- Checked 
																</th>-->
																<th>Package Type</th>
																<th>Cost</th>
																<th>Credits Point</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(!$package->isEmpty())
															@foreach($package as $row)
																<tr>
																	<!--<td><input type="checkbox" name="user[]" value="{{@$row->user_id}}"/></td>
																	<td>-->
																	<td>
																	@if($row->package_type == 1)Bronze
																	@elseif($row->package_type == 1)Silver
																	@elseif($row->package_type == 1)Gold
																	@endif
																	</td>
																	<td>
																	£ {{@$row->cost}}
																	</td>
																	<td>
																	{{@$row->credit_you_recieve}}
																	</td>
																	<td>@if($row->package_status == 0)Inactive
																	@elseif($row->package_status == 1)Active
																	@endif</td>
																	<td>
																	<a href="admin-customer-details/{{$row->package_id}}" title="View"> <i class="fa fa-eye delet" aria-hidden="true"></i></a>
																		@if($row->package_status == 0)
																		<a href="admin-customer-status/{{$row->package_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check cncl1" aria-hidden="true"></i></a>
																		@elseif($row->package_status == 1)
																		<a href="admin-customer-status/{{$row->package_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times delet" aria-hidden="true"></i></a>
																		@endif
																	</td>
																</tr>
																@endforeach
																@else
																	<tr><td colspan="5">No Record Found</td></tr>
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