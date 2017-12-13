<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UsersToLogo extends Model
{
    protected $table ='users_to_logo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	protected $primaryKey='logo_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
	
	public function user(){
		return $this->belongsTo('App\User','user_id');
	}
	
}
