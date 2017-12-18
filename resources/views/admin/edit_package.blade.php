@extends('admin.layout.app')
@section('title','Edit Package')
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
						<h4 class="pull-left page-title">Edit Package</h4>
						<div class="submit-login pull-right">
							<a href="admin-package-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body table-rep-plugin">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12 nhp">
										<div class="table-responsive" data-pattern="priority-columns">
											<form id="add_package" action="admin-edit-package/{{$package->package_id}}" method="post">
											{{csrf_field()}}
											<!--all_time_sho-->       
											<div class="all_time_sho"> 
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
													<label for="exampleInputEmail1">Package Type</label>
													<select class="form-control newdrop required" name="package_type" >
															<option value="">Select</option>
															<option value="1" @if($package->package_type == 1){{'selected'}}@endif>Bronze</option>
															<option value="2"  @if($package->package_type == 2){{'selected'}}@endif>Silver</option>
															<option value="3" @if($package->package_type == 3){{'selected'}}@endif>Gold</option>
														</select>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Package Price</label>
														<input type="text" class="form-control required" name="cost" value="{{$package->cost}}">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Credit Point</label>
														<input type="text" class="form-control required" name="credit_point" value="{{$package->credit_point}}">
													</div>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Package Description</label>
														<textarea placeholder="" rows="3" class="form-control message required froala-editor" name="package_description">{{@$package->package_description}}</textarea>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="add_btnm">
														<input value="Update" type="submit">
													</div>
												</div>
												<!--all_time_sho-->  
											</form>   
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- End Row -->
			</div> <!-- container -->
		</div> <!-- content -->
	</div>
</div>
</div>
<script>
	$(document).ready(function(){//alert();
		$('#add_package').validate();
	});
</script>
@endsection     