<?php
	function fetch_user($user_id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$user_id)->first();
		return $user;
	}
?>