<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentVault extends Model
{
    protected $table ='payment_vault';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='vault_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function scopeCardExistInVault($query,$user_id,$card_no){
        return $query->where('card_no',$card_no)->where('user_id',$user_id);
    }
    public function scopeUser($query,$user_id){
        return $query->where('user_id',$user_id);
    }
    public function scopeUserActiveCard($query,$user_id){
        return $query->where('user_id',$user_id)->where('status',1);
    }

}
