<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    protected $table ='credit_transaction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='transaction_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
    
    public function scopeMember($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
