<?php

namespace App\Http\Controllers;
use App\Users;
use App\Package;
use App\OrderDetails;
use App\PaymentVault;
use App\CreditTransaction;
use Illuminate\Http\Request;
use DB;
class PackageOrderDetails extends Controller
{
    public function savePackageDetails($order_details){
        //save order details
        $userid=$order_details['user_id'];
        $orders_data=new OrderDetails;
        $unique_order_no = time() . mt_rand() . $userid;
        $orders_data->order_no=$unique_order_no;
        $orders_data->package_id=$order_details['package_id'];
        $package_period=$this->calculate_package_period($order_details['duration']);
        $orders_data->membership_end=$package_period['membership_end'];
        $orders_data->order_date =Date('Y-m-d H:i:s');
        $orders_data->user_id=$userid;
        $orders_data->customer_id=$order_details['stripe_customer_id_for_transaction'];
        $orders_data->stripe_transaction_id=$order_details['stripe_transaction_id'];
        $orders_data->amount=$order_details['package_details']['cost'];
        $orders_data->auto_renewal=$order_details['auto_renewal'];
        $orders_data->order_status='Completed';
        $orders_data->activation_by_automated_script=$order_details['activation_by_automated_script'];
        $orders_data->save();

        //save card details to vault with order
        $vault_details=new PaymentVault;
        $vault_details->stripe_customer_id_for_transaction=$order_details['stripe_customer_id_for_transaction'];
        $vault_details->order_no=$unique_order_no;
        $vault_details->user_id=$order_details['user_id'];
        $vault_details->save();
        
        //save credit point;. table only save for credit package point
        if($order_details['credit_point']!=0){
            $credit_transaction=new CreditTransaction;
            $credit_transaction->transaction_type='Incoming';
            $credit_transaction->credit=$order_details['credit_point'];
            $credit_transaction->transaction_date=Date('Y-m-d H:i:s');
            $credit_transaction->user_id=$order_details['user_id'];
            $credit_transaction->save();
        }  
    }
    public function calculate_package_period($period)
    {
        // $date = strtotime(date("Y-m-d", strtotime($date)) . " +12 month");
        // $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
        // $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 week");
        // $date = strtotime(date("Y-m-d", strtotime($date)) . " +2 week");
        // $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
        // $date = strtotime(date("Y-m-d", strtotime($date)) . " +30 days");
        $today=Date('Y-m-d');
        if($period==1){
            $date =  strtotime(date("Y-m-d", strtotime($today)) . " +3 month");
            $membership_end = date("Y-m-d", $date);
        }else if($period==0){
          $membership_end='';
        }
        return array('membership_end'=>$membership_end);
    }
    
}
