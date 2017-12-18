@if(!$get_user->isEmpty())
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
				<h4>Proposal From {{@$user->user_name}}</h4>
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
					<li>({{ceil($user->avg_review).'.0'}})</li>
				</ul>
				<span><img src="images/ttags.png" alt="">${{number_format($user->price)}}</span>
				<span><img src="images/ccal.png" alt="">{{date('d F Y',strtotime($user->started_date))}}</span>
				<span class="show1">{{$user->description}}</span>
			</div>
			<div class="invite_rev">
				<a class="invite_btn" href="#"><img src="images/one.png" alt=""> Read More</a>
				<a class="invite_btn viw_pf" href="profile/{{$user->user_slug}}"><img src="images/eyes.png" alt=""> View Profile</a>
				<?php $fetch = hired_builder($user->job_id);?>
				@if(count($fetch)>0)
					@if($user->job_invitation_id == $fetch{0}->job_invitation_id)
						<a class="invited_btn"><i class="fa fa-handshake-o" aria-hidden="true"></i> Hired</a>
					@endif
					@else
						<a class="invite_btn hired" id="hire_{{$user->job_invitation_id}}" href="javascript:void(0);" data-id="{{$user->job_invitation_id}}"><img src="images/tow.png" alt=""> Hire</a>
				@endif
			</div>
		</div>
	@endforeach
	@else
		<div class="no_invited">No builder proposal found for this job.</div>
@endif