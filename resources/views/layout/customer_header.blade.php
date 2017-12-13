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
							<li><a href="my-posted"><img src="images/mail.png" alt="">My Posted Jobs</a></li>
							<li><a href="#" class="credits"><img src="images/jobs.png" alt="">Jobs Given</a></li> 
							<li><a href="logout" ><img src="images/logout.png" alt="">Logout</a></li>  
						</ul>
					</div>
				</div>
				<div class="review_area">
					<div class="floatt_right">
						<div class="profile_pic">
							<?php $user = fetch_user(session()->get('user_id'));?>
							<a href="javascript:void(0);" class="aa"> 
								<img src="images/profile_img.jpg" class="img-circle"> <i class="fa fa-caret-down" aria-hidden="true"></i> <div class="dropss_down" style="display:none;">
									<ul>
										<li><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Profile</a> </li>
										<li><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>  Edit Profile </a></li>
										<li><a href="#"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>  Settings</a> </li>
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
		<img src="images/inner_banner.jpg"  alt="inner_banner">
		<div class="adnew1 post_btn">
			<a data-toggle="modal" data-target="#myModal4" class="sub_bttn" id="job_post" href="#">Post New Jobs</a>
		</div>
	</div>
</div>