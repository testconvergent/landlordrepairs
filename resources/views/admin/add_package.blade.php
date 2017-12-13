@extends('admin.layout.app')
@section('title','Add Package')
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
						<h4 class="pull-left page-title">Add Package</h4>
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
											<form id="add_package" action="admin-package-list" method="post">
											{{csrf_field()}}
											<!--all_time_sho-->       
											<div class="all_time_sho"> 
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
													<label for="exampleInputEmail1">App Version</label>
													<input type="text" class="form-control required" name ="app_code" placeholder="">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail" id="datecreate">
														<label for="exampleInputEmail1">Uploaded Date</label>
														<input type="text" class="form-control required" name ="update_date" placeholder="" id="update_date" readonly>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail" id="datecreate">
														<label for="exampleInputEmail1">Expire Date</label>
														<input type="text" class="form-control required" name ="expired_date" placeholder="" id="expired_date" readonly>
													</div>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">App Description</label>
														<textarea placeholder="" rows="3" class="form-control message required froala-editor" name="version_feature" id="blog_content"></textarea>
														<span class="error content_error" id="static_page_content_error"></span>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="add_btnm">
														<input value="Add" type="submit">
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