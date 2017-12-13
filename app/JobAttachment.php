<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class JobAttachment extends Model
{
    protected $table ='job_to_attachment';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='attachment_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
}
