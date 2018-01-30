<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\OrderDetails;
use App\PaymentVault;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
class AutoRenewalMembershipController extends Controller
{
    public $stripe;
    public $stripe_customer_id;
    public $stripe_final_charge_status;
    public $stripe_transaction_id;
    public function fnToRenewMembership()
    {
        $today=strtotime(Date('Y-m-d'));
        $renewal_date=OrderDetails::where('activation_by_automated_script', 'Yes')->groupBy('customer_id')->get();
        if (@$renewal_date) {
            foreach ($renewal_date as $row) {
                $membership_end=strtotime(date("Y-m-d", strtotime($row->membership_end)) . " +1 day");
                if ($today==$membership_end) {
                    $user_id=$row->user_id;
                    // $active_card_details=PaymentVault::userActiveCard($user_id)->first();
                    $this->stripe_customer_id=$row->customer_id;
                    $amount= $row->amount;
                    $charge_details='Membership 3 months';
                    $this->fnToGnereateCharge($amount, $charge_details);
                    if ($this->stripe_final_charge_status=='succeeded') {
                        $package_obj  =new PackageOrderDetails();
                        $order_details=array(
                            'user_id'=>$this->user_id,
                            'package_details'=>$activation_package_details,
                            'cost'=>$activation_package_details->cost,
                            'duration'=>$activation_package_details->duration,
                            'package_id'=>$activation_package_details->package_id,
                            'token_id'=>$this->stripe_transaction_id,
                            'stripe_transaction_id'=>$this->stripe_transaction_id,
                            'credit_point'=>'',
                            'stripe_customer_id_for_transaction'=>$this->stripe_customer_id,
                            'auto_renewal'=>$activation_package_details->auto_renewal,
                            'activation_by_automated_script'=>'Yes'
                        );
                        $package_obj->savePackageDetails($order_details);
                    }
                    sleep(10);
                }
            }
        }
    }

    public function fnToGnereateCharge($amount, $charge_details)
    {
        $charge = $this->stripe->charges()->create([
            'currency' => 'GBP',
            'amount'   => $amount,
            "customer" => $this->stripe_customer_id,
            'description' =>$charge_details,
        ]);
        $this->stripe_transaction_id=$charge['id'];
        $this->stripe_final_charge_status= $charge['status'];
    }
}
