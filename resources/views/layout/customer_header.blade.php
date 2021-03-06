<div class="row Nomarg">
	<div class="header_builder">
		<div class="container">
			<div class="logo_builder_pg">
				<a href="{{url('/')}}"><img src="images/logo.png"  alt="logo" class="img-responsive"></a>
			</div>
			<div class="without_review">
				<div class="inner_header_area">
					<div class="searches_bbox" style="display:none;">
						<div class="inner_search_box"><img src="images/top_arrow.png" class="arrow" >
						<input class="form-control" type="text" placeholder="Default input"></div>
					</div>
					<button type="button" class="navbar-toggle pposs" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar bblack"></span>
						<span class="icon-bar bblack"></span>
						<span class="icon-bar bblack"></span>                        
					</button>
					<div class="collapse navbar-collapse drop_ddown popad" id="myNavbar">
						<ul>
							<li><a data-toggle="modal" data-target="#myModal1" href="#"><img src="images/like.png" alt=""> Recommend us</a></li>
							<li><a href="my-jobs"><img src="images/mail.png" alt="">My Posted Jobs</a></li>
							<li><a href="jobs-given" class="credits"><img src="images/jobs.png" alt="">Jobs Given</a></li> 
							<li><a href="logout" ><img src="images/logout.png" alt="">Logout</a></li>  
						</ul>
					</div>
				</div>
				<div class="review_area">
					<div class="floatt_right">
						<div class="profile_pic">
							<?php $user = fetch_user(session()->get('user_id'));?>
							<a href="javascript:void(0);" class="aa"> 
								@if(@$user->prof_image)
									<img src="{{url('public/prof_image/'.$user->prof_image)}}" class="img-circle"> <i class="fa fa-caret-down" aria-hidden="true"></i> 
								@else
									<img src="images/noimages.png" class="img-circle"> <i class="fa fa-caret-down" aria-hidden="true"></i> 
								@endif
								<div class="dropss_down" style="display:none;">
									<ul>
										<li><a href="javascript:void(0);"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Profile</a> </li>
										<li><a href="edit-profile"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>  Edit Profile </a></li>
										<li><a href="javascript:void(0);"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>  Settings</a> </li>
									</ul>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="inner_banner_builder">
		<h3 class="user_name">{{$user->user_name}}</h3>
		<img src="images/inner_banner.jpg"  alt="inner_banner">
		@if(Request::segment(1) != 'profile' && Request::segment(2) =="")
		<div class="adnew1 post_btn">
			<a data-toggle="modal" data-target="#myModal4" class="sub_bttn" id="job_post" href="#">Post New Jobs</a>
		</div>
		@endif
	</div>
</div>
<!--Recommend Us-->
<div id="myModal1" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title">Recommend us </h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB">
				<form class="modal_form_rreview" action="send-recommend-us-mail" id="send-recommend-us-mail" method="post">
				{{csrf_field()}}
					<div class="col-md-12 popad">
						<div class="recomnd">
							<h5>Recommend us to a </h5>
							<div class="radio_area">
									<p>
									<input type="radio" id="test1" name="user_type" value="tradesperson" checked>
									<label for="test1">Tradesperson </label>
									</p>
								  <p>
								    <input type="radio" id="test2" value="landlord" name="user_type">
									<label for="test2"> Landlord </label>
								 </p>
							</div>
						<div class="col-sm-12 col-lg-12 col-md-12">
						  <div class="form-group">
							<label class="control-label" for="pwd">Name</label>
							<input type="text" class="form-control required" name="name" id="name" placeholder="Name">
						  </div>
						  <div class="form-group">
							<label class="control-label" for="pwd">Email</label>
							<input type="email" class="form-control required" name="email" id="Email" placeholder="Email">
						  </div>
						  <div class="form-group">
							<label class="control-label" for="pwd">Phone</label>
							<input type="text" class="form-control required" name="phone" id="phone" placeholder="Phone">
						  </div>
						  <div class="form-group">
							<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control required" rows="3" id="comment" name="description" placeholder="Type your description here"></textarea>
						</div>
						  </div>
					   </div>
							<button type="submit" class="btn btn-primary mark_com pull-left post_bbttn">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> 
<!--Recommend Us-->
<!--Add Job-->
<div id="myModal4" class="modal fade" role="dialog">
	<div class="modal-dialog invite_modil">
	<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
				<h4 class="modal-title">New Jobs</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB inv_1">
				<form class="modal_form_rreview" method="post" action="post-job" id="job_post_frm" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Job Type</label>
							<select class="pop_select" name="job_type_id" id="job_type_id">
							<option value="">Job type</option>
							<?php $job_type = job_type();?>
							@if(!$job_type->isEmpty())
								@foreach($job_type as $job)
									<option value="{{@$job->job_type_id}}">{{@$job->job_type_name}}</option>
								@endforeach
							@endif
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Category</label>
							<select class="pop_select" name="job_category_id" id="job_category_id">
								<option value="">Category</option>
								<?php $category = job_category();?>
								@if(!$category->isEmpty())
									@foreach($category as $cat)
										<option value="{{@$cat->category_id}}">{{@$cat->category_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="pwd">Looking For</label>
							<input type="text" class="form-control" name="looking_for" id="looking_for" placeholder="Looking for">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Budget</label>
							<input type="text" class="form-control" name="budget" id="budget" placeholder="Budget (£)" onkeypress="validate(event)">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Deadline</label>
							<div class="ccal">
								<img src="images/call.png" >
								<input type="text" class="form-control" id="datepicker" name="deadline" placeholder="Deadline" style="background:#fff" readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">City</label>
							<input type="text" class="form-control" name="city" id="city" placeholder="City">
							<input type="hidden" id="longitude" name="longitude">
							<input type="hidden" id="lattitude" name="lattitude">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Post Code</label>
							<input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Post Code">
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control " rows="3" id="comment" name="job_details"></textarea>
						</div>
					</div>
					<div class="col-sm-5 col-lg-5 col-md-5">
						<div class="form-group">
							<div class="Uploadbtn">
								<input type="file" id="uploadBtn1" class="input-upload" name="attachment[]" multiple>
								<span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
							</div>
							<span class="fil_txt1"></span>
						</div>
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<span class="span_erro"></span>
					</div>
					<div class="col-sm-3 col-lg-3 col-md-3">
						<button type="submit" class="btn btn-primary mark_com pull-right MargT30 post_bbttn">Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> 
<script>
$("#send-recommend-us-mail").validate();
</script>
<!--Add Job-->