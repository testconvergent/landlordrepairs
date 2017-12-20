      <div class="header_builder">
		<div class="container">
          <div class="logo_builder_pg"> <a href="{{url('')}}"> <img src="images/logo.png"  alt="logo" class="img-responsive"> </a> </div>
          <div class="inner_header_area">
        <div class="only_search"> <a href="javascript:void(0)" class="ssearch"><img src="images/search_ico.png" ></a>
              <div class="searches_bbox" style="display:none;">
            <div class="inner_search_box"><img src="images/top_arrow.png" class="arrow" >
                  <input class="form-control" type="text" placeholder="Search">
                  <button type="submit" class="btn btn-default search_submit"><img src="images/search.png" alt=""></button>
                </div>
          </div>
            </div>
        <button type="button" class="navbar-toggle pposs" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar bblack"></span> <span class="icon-bar bblack"></span> <span class="icon-bar bblack"></span> </button>
        <div class="collapse navbar-collapse drop_ddown" id="myNavbar">
              <ul>
            <li><a href="my-invited">New Invites <span>({{App\JobInvitation::newJobInvitation(session()->get('user_id'))->count()}})</span></a></li>
            <li><a href="my-awarded-job"><img src="images/ico01.png">Awarded Jobs</a></li>
            <li><a href="javascript:void(0);" class="credits"><img src="images/ico02.png">Credits<span>(6)</span></a></li>
          </ul>
            </div>
      </div>
          <div class="review_area">
		<?php $win_job = job_win();?>
        <div class="floatt_right">
              <div class="rreview" >
            <ul>
				<?php 
				$review_point = floor(@$win_job->avg_review);
				for($i=1;$i<=5;$i++){
				if($i <= $review_point){?>
					<li><img src="images/sstar.png" alt=""></li>
					<?php
					}
					else{?>
					<li><img src="images/sstar_1.png" alt=""></li>
					<?php
					}
				}?>
            </ul>
            <div class="clearfix"></div>
            <p>{{$win_job->job_win}} Jobs Win, {{$win_job->tot_review}} Reviews</p>
          </div>
              <div class="profile_pic"> <a href="javascript:void(0)" class="aa"> <img src="images/profile_img.jpg" class="img-circle"> <i class="fa fa-caret-down" aria-hidden="true"></i>
            <div class="dropss_down" style="display:none;">
                  <ul>
                <li><a href="my-profile"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Profile</a> </li>
                <li><a href="my-profile"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Edit Profile </a></li>
                <li><a href="javascript:void(0)"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Settings</a> </li>
                <li><a href="javascript:void(0)"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Recommend us </a></li>
                <li><a href="logout"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Logout </a></li>
              </ul>
                </div>
            </a> </div>
            </div>
      </div>
        </div>
  </div>