<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class JobToJobCategory extends Model
{
    protected $table ='job_to_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='job_cat_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;	
	
	public function getCateGoryDetails(){
		
		return $this->belongsTo('App\JobCategory', 'category_id', 'category_id');

	}
	public function getJobDetails(){		
		return $this->belongsTo('App\Jobs', 'job_id', 'job_id');
	}
	public function job(){
		return $this->belongsTo('App\Jobs','job_id','job_id');
	}
	public function category(){
		return $this->belongsTo('App\JobCategory','category_id','category_id');
	}
}
