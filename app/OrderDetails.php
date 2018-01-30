<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table ='order_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $primaryKey='order_id';
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
    public function packageDetails()
    {
        return $this->hasOne('App\Package', 'package_id', 'package_id');
    }
    public function scopeCuurentPackage($query){
        return $query->orderBy('order_details','desc');
        //0 means unlimited
    }
    public function scopePreviousPackage($query)
    {
        return $query->where('membership_end', '<', Date('Y-m-d'))->orderBy('order_id', 'desc')->take(1);
    }
    // public function scopeTotalCreditPoint($query){
    //     return $query->where('credit_end', '>=', Date('Y-m-d'));
    // }
    
}
