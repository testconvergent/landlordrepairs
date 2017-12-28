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
				<p class="show1">{{str_limit($user->description,120)}}</p>
			    <p class="collapse">
				{{$user->description}}<br>
							<div class="attac_area" id="attach_file_1">							
							<a href="{{url('/storage/invitation_attachment/'.$user->attachment)}}" download="{{$user->attachment}}">Attachment</a>							
				</div>
				</p>
			</div>
			<div class="invite_rev">
				<a class="invite_btn read_more"  href="javascript:void(0);"><img src="images/one.png" alt="" > Read More</a>
				<a target="_blank" class="invite_btn viw_pf" href="profile/{{$user->user_slug}}"><img src="images/eyes.png" alt=""> View Profile</a>
				<a class="invite_btn hired" id="hire_{{$user->job_invitation_id}}" href="javascript:void(0);" data-id="{{$user->job_invitation_id}}"><img src="images/tow.png" alt=""> Hire</a>
			</div>
		</div>
	@endforeach
	@else
		<div class="no_invited">No builder proposal found for this job.</div>
@endif
