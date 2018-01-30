<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class JobInvitation extends Model
{
    protected $table ='job_invitation';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='job_invitation_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
	public function scopeInvitedProvider($query,$provider_id){
		return $query->where('to_user_id',$provider_id)->whereIn('invitation_status',[0,1,4]);
	}
	public function scopeNewJobInvitation($query,$provider_id){
		return $query->where('to_user_id',$provider_id)->where('invitation_status',0)->where('invitation_read',0);
	}
	
	public function scopeAwaredProvider($query,$provider_id){
		return $query->where('to_user_id',$provider_id)->whereIn('invitation_status',[2,3]);
	}
	
	public function providerJobDetails(){
		return $this->hasMany('App\Jobs','job_id','job_id');
	}
	public function categoryDetails(){
		return $this->hasOne('App\JobToJobCategory','job_id','job_id');
	}
	public function scopeFilterBydate($query,$form_date,$to_date){
		if(@$form_date && @$to_date){
		 return $query->whereBetween('awarded_job_date',[$form_date,$to_date]);	
		}
	}
	public function jobReview(){
		return $this->hasOne('App\UsersToReview','job_id','job_id');
	}
	public function jobAttachment(){
		return $this->hasMany('App\JobAttachment','job_id','job_id');
	}
	
}
