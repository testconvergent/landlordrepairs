<?php
	function fetch_user($user_id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$user_id)->first();
		return $user;
	}
	function get_invited($user_id,$job_id)
	{
		$fetch = DB::table(TBL_JOB_INVITATION)
		->where('job_id',$job_id)
		->where('to_user_id',$user_id)
		->where('from_user_id',session()->get('user_id'))
		->first();
		return $fetch;
	}
	function count_proposal($job_id)
	{
		$fetch = DB::table(TBL_JOB_INVITATION)->where('invitation_status','!=',0)->where('job_id',$job_id)->get();
		return $fetch;
	}
	function hired_builder($job_id)
	{
		$fetch = DB::table(TBL_JOB_INVITATION)->where('invitation_status',2)->orwhere('invitation_status',3)->where('job_id',$job_id)->get();
		return $fetch;
	}
	function job_category()
	{
		$fetch_category = DB::table(TBL_JOB_CATEGORY)->where('category_status',1)->get();
		return $fetch_category;
	}
	function job_type()
	{
		$fetch_job_type = DB::table(TBL_JOB_TYPE)->where('job_type_status',1)->get();
		return $fetch_job_type;
	}
?>