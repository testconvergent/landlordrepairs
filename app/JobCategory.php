<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class JobCategory extends Model
{
    protected $table ='job_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='category_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
	
	public function cateGoryJobDetails(){
		$this->hasMany('App\JobToJobCategory','category_id');
	}
	public function ScopeActive($query){
		return $query->where('category_status',1);
	}
}
