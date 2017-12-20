@if(!$get_user->isEmpty())
	<p>{{@$get_user{0}->category_name}} for the job of <strong>{{@$job->looking_for}} </strong> at the location {{@$job->city}}.</p>
	<div class="scr">		
		@foreach($get_user as $user)
			<div class="invite_box">
				<div class="invite_img">
					@if(@$user->prof_image)
						<img src="{{url('public/prof_image/'.$user->prof_image)}}" alt="">
					@else
						<img src="images/noimages.png" alt="">
					@endif
				</div>
				<div class="invie_del">
					<h4>{{@$user->user_name}}</h4>
					<span><img src="images/black.png" alt="">{{@$user->category_name}}</span>
					<p>{{@$user->prof_description}}</p>
				</div>
				<div class="invite_rev">
					<ul>
						<?php 
						$review_point = floor(@$user->avg_review);
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
					<?php $invited = get_invited($user->user_id,$job_id);?>
					@if(count($invited)>0)
						<a class="invited_btn"><i class="fa fa-check-circle" aria-hidden="true"></i> Invited</a>
						
					@else
						<a class="invite_btn invited_user" id="invite_{{$user->user_id}}" href="javascript:void(0);" data-id="{{$user->user_id}}" data-job_id="{{@$job_id}}"><img src="images/luser.png" alt=""> Invite</a>
					@endif
					<a target="_blank" class="invite_btn viw_pf" href="profile/{{$user->user_slug}}"><img src="images/eyes.png" alt=""> View Profile</a>
				</div>
			</div>
		@endforeach
		@else
			<div class="no_invited">No builder found for the job of <strong>{{@$job->looking_for}} </strong> at the location {{@$job->city}}.</div>
	</div>
@endif