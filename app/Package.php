<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Package extends Model
{
    protected $table ='package';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
	 protected $primaryKey='package_id';	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
    public function scopeGetPackagePrice($query,$package_id){
        return $query->where('package_id',$package_id);
    }
    public function scopeMembershipPackageDetails($query){
        return $query->where('package_type',1)->first();
    }
}
