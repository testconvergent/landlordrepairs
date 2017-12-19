<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UsersToReview extends Model
{
    protected $table ='review';
	protected $primaryKey='review_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
	public function review(){
		return $this->hasOne('App\User','user_id','user_id');
	}
}
