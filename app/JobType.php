<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class JobType extends Model
{
    protected $table ='job_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='job_type_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
}
