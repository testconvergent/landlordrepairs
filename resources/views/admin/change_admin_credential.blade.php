@extends('admin.layout.app')
@section('title','Change Credential')
@section('body')
	<div id="wrapper">
		@include('admin.layout.header')
		@include('admin.layout.nav')                  
		<div class="content-page">
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h4 class="pull-left page-title">Change Credential</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
							    @if(@session()->get('success'))<div class="alert alert-success ">{{session()->get('success')}}</div>@endif
								@if(@session()->get('error'))<div class="alert alert-danger">{{session()->get('error')}}</div>@endif
								<div class="panel-body table-rep-plugin">
									<div class="row">
									    <form action="" method="post" id="form">
										    {{csrf_field()}}
											<div class="row">
												<div class="col-md-5 col-sm-5 col-xs-12 col-lg-5">
													<div class="your-mail">
														<label for="exampleInputEmail1">User Name</label>
														<input class="required" placeholder="User Name" type="email"  name="user_name" value="{{@$admin->email}}">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5 col-sm-5 col-xs-12 col-lg-5">
													<div class="your-mail">
														<label for="exampleInputEmail1">New Password</label>
														<input class="required" placeholder="New Password"  type="password" value="" name="new_password" id="new_password" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5 col-sm-5 col-xs-12 col-lg-5">
													<div class="your-mail">
														<label for="exampleInputEmail1">Confirm New Password</label>
														<input class="required" placeholder="Confirm New Password"  type="password" value="" name="conf_password" id="conf_password">
													</div>
												</div>
											</div>
										    <div class="clearfix"></div>
											<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
												<div class="submit-login no_mmg">
													<button type="submit" class="btn btn-default">Save</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>  
			</div> 
        </div>
	</div>
	 <script>
	  $(document).ready(function(){
		  $("#form").validate({
			rules: {
				conf_password: {
				  equalTo: "#new_password"
				}
			}
		});
	  });
	  </script>
@endsection     