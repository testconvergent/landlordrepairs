<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Jobs extends Model
{
    protected $table ='jobs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='job_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
	
	public function jobAttachmentDetails(){
		return $this->hasMany('App\JobAttachment','job_id');
	}
	public function jobToCategory(){
		return $this->hasMany('App\JobToJobCategory','job_id');
		//->belongsTo('App\JobCategory', 'category_id', 'category_id');
	}
	public function users(){
		return $this->belongsTo('App\User','user_id','user_id');		
	}
	public function jobType(){
		return $this->hasOne('App\JobType','job_type_id','job_type_id');
	}
	public function attachment(){
		return $this->hasOne('App\JobAttachment','job_id','job_id');
	}
}
