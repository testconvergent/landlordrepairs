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
	public function trade(){
		return $this->hasOne('App\JobCategory','category_id', 'primary_trade');
	}
	public function scopeProvider($query,$user_id)
    {
        return $query->where('user_type',2)->where('user_status',1)->where('user_id',$user_id);
    }
	
	public function scopeCustomer($query){
		 return $query->where('user_type',3)->where('user_status',1);
	}
	public function logos(){
		return $this->hasMany('App\UsersToLogo','user_id');
	}
	public function portFolio(){
		return $this->hasMany('App\UsersToPortFolio','user_id');
	}
	
	public function scopeTradesManProfile($query,$pro_slug){
        return $query->where('user_type',2)->where('user_status',1)->where('user_slug',$pro_slug);
    }
	
}
