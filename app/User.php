<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table ='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='user_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
	
	public function get_providers_details(){
		return $this->hasOne('App\JobCategory','category_id', 'primary_trade');
	}
	
}
