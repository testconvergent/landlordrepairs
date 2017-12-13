<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserToPortPolio extends Model
{
    protected $table ='users_to_portfolio';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='portfolio_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
}
