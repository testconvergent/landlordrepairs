<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use App\Package;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
class StripeController extends Controller
{
    /**
      * Show the application paywith stripe.
      *
      * @return \Illuminate\Http\Response
      */
    public $stripe;
    public $user_id;
    public $user_email;
    public $stripe_token_id;
    public $stripe_customer_id;
    public $stripe_transaction_id;
    public $stripe_final_charge_status;
    public $stripe_subscription_status;
    public function __construct(){
        $this->stripe=Stripe::make('sk_test_4N6dcVTgrqTQOHW8TlBeMWUH');
    }
    public function intialize(){
          $this->user_id=session()->get('registration_id');
          $this->user_email=User::find(session()->get('registration_id'))->email;        
    }
    public function fnToGenerateStripeTransactionToken($request){
        $token=$this->stripe->tokens()->create([
            'card' => [
                'number'    => $request->get('card_no'),
                'exp_month' => $request->get('ccExpiryMonth'),
                'exp_year'  => $request->get('ccExpiryYear'),
                'cvc'       => $request->get('cvvNumber'),
            ],
        ]);
        $this->stripe_token_id=$token['id'];      
    }
    public function fnToCreateCustomer(){
        $customer = $this->stripe->customers()->create(array(
            "email" => $this->user_email,
            "source" => $this->stripe_token_id,
          ));
        $this->stripe_customer_id=$customer['id'];      
    }
    public function fnToGnereateCharge($amount, $charge_details){
        $charge = $this->stripe->charges()->create([
            'currency' => 'GBP',
            'amount'   => $amount,
            "customer" => $this->stripe_customer_id,
            'description' =>$charge_details,
        ]);
         $this->stripe_transaction_id=$charge['id'];
         $this->stripe_final_charge_status= $charge['status'];       
    }
    public function create_membership_subscription_plan($amount, $plan_name, $insterval, $id){
        $plan = $this->stripe->plan()->create([
            'currency' => 'GBP',
            'interval' => $insterval,
            'name' => $plan_name,
            'amount' => $amount,
            'id' => $id,
        ]);
    }
    public function payWithStripe(){
        return view('paywithstripe');
    }
    public function create_subscription($subscription_name){
        $sub1 =$this->stripe->Subscriptions()->create($this->stripe_customer_id, [
            'plan' =>$subscription_name,
            'quantity'=>12
        ]);
        $this->stripe_transaction_id=$sub1['id'];
        $this->stripe_subscription_status=$sub1['status'];
    }
    public function postPaymentWithStripe(Request $request){       
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
           // 'amount' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $this->intialize();
                $this->fnToGenerateStripeTransactionToken($request);               
                $this->fnToCreateCustomer();
                if (!@$this->stripe_token_id) {
                    \Session::put('error', 'The Stripe Token was not generated correctly');
                    return redirect()->route('payment');
                }
                // Member activation package + Is it auto renual or not                
                $amount=0;
                $activation_package_details=Package::membershipPackageDetails();                
                $amount= $amount+$activation_package_details->cost;
                $charge_details='Membership 3 months';                
                if ($request->auto_renew=='Yes'){
                    $activation_package_details->auto_renewal='Yes';
                }else{
                    $activation_package_details->auto_renewal='No';
                }
                $credit_point_success='';                
                if ($request->auto_renew=='Yes' && $request->credit_package_id==0) {
                    $subscription_name='activation';
                    $subscription_details=$this->create_subscription($subscription_name);
                    $activation_package_details->activation_by_automated_script='No';  
                } elseif ($activation_package_details->auto_renewal=='No' && $request->credit_package_id==0){
                    $activation_package_details->activation_by_automated_script='No';  
                    $this->fnToGnereateCharge($amount, $charge_details);
                } elseif ($request->credit_package_id!=0){
                    $credit_package_details=Package::find($request->credit_package_id);
                    $credit_package_details->auto_renewal='No';
                    $amount=$amount+$credit_package_details->cost;
                    $charge_details.=$charge_details. '+'.$credit_package_details->credit_type_package_name;
                    $credit_point_success=' + Sucessfully added your credit point.'; 
                    $activation_package_details->activation_by_automated_script='Yes';                  
                    $this->fnToGnereateCharge($amount, $charge_details);
                }
                if ($this->stripe_final_charge_status == 'succeeded') {
                    $this->fnToSaveTransationDetailsForActivation($activation_package_details);
                    if ($request->credit_package_id!=0) {
                        $this->fnToSaveTransationDetailsForCreditPoint($credit_package_details);
                    }                   
                    $registration_id=session()->get('registration_id');
                    session()->get('registration_id','');
                    session()->put('user_id',$registration_id);
                    \Session::put('success', 'Membership package has been activated to your account.'.$credit_point_success);
                    return redirect()->route('my-credits');
                }
                if ($this->stripe_subscription_status == 'active') {
                    $this->fnToSaveTransationDetailsForActivation($activation_package_details);
                    $registration_id=session()->get('registration_id');
                    session()->get('registration_id','');
                    session()->put('user_id',$registration_id);
                    \Session::put('success', 'Membership package has been activated to your account.');
                    return redirect()->route('my-credits');
                } else {
                    \Session::put('error', 'Something wrong with the payment.');
                    return redirect()->route('payment');
                }
            } catch (Exception $e) {
                \Session::put('error', $e->getMessage());
                return redirect()->route('payment');
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error', $e->getMessage());
                return redirect()->route('payment');
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error', $e->getMessage());
                return redirect()->route('payment');
            }
        }
        \Session::put('error', 'All fields are required!!');
        return redirect()->route('payment');
    }
    public function fnToSaveTransationDetailsForActivation($activation_package_details){
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
            'activation_by_automated_script'=>$activation_package_details->activation_by_automated_script,
        );
        $package_obj->savePackageDetails($order_details);
    }
    public function fnToSaveTransationDetailsForCreditPoint($credit_package_details){
        $package_obj  =new PackageOrderDetails();
        $order_details=array(
            'user_id'=>$this->user_id,
            'package_details'=>$credit_package_details,
            'cost'=>$credit_package_details->cost,
            'duration'=>$credit_package_details->duration,
            'package_id'=>$credit_package_details->package_id,
            'stripe_transaction_id'=>$this->stripe_transaction_id,
            'credit_point'=>$credit_package_details->credit_point,
            'stripe_customer_id_for_transaction'=>$this->stripe_customer_id,
            'auto_renewal'=>$credit_package_details->auto_renewal,
            'activation_by_automated_script'=>'No',
        );
        $package_obj->savePackageDetails($order_details);
    }
    public function payment_for_credit_from_dashboard(Request $request){
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'credit_package_id'=>'required',
        ]);      
        if ($validator->passes()) {
            try {
                $this->intialize();
                $this->fnToGenerateStripeTransactionToken($request);
                $this->fnToCreateCustomer();
                if (!@$this->stripe_token_id) {
                    \Session::put('error', 'The Stripe Token was not generated correctly');
                    return redirect()->route('my-credits');
                }
                // Member activation package + Is it auto renual or not              
                $credit_package_details=Package::find($request->credit_package_id);
                $credit_package_details->auto_renewal='No';
                $amount=$credit_package_details->cost;
                $charge_details=$credit_package_details->credit_type_package_name;               
                $this->fnToGnereateCharge($amount, $charge_details);
                if ($this->stripe_final_charge_status == 'succeeded') {
                    $this->fnToSaveTransationDetailsForCreditPoint($credit_package_details);
                    \Session::put('success', 'Sucessfully added your credit point.');
                    return redirect()->route('my-credits');
                } else {
                    \Session::put('error', 'Money not add in wallet!!');
                    return redirect()->route('my-credits');
                }
            } catch (Exception $e) {
                \Session::put('error', $e->getMessage());
                return redirect()->route('my-credits');
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error', $e->getMessage());
                return redirect()->route('my-credits');
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error', $e->getMessage());
                return redirect()->route('my-credits');
            }
        }
        \Session::put('error', 'All fields are required!!');
        return redirect()->route('my-credits');
    }
    public function handleWebhook(Request $request){

        // Retrieve the request's body and parse it as JSON
       // $input = @file_get_contents("php://input");
       echo 'gf';
       $input='{
        "created": 1326853478,
        "livemode": false,
        "id": "evt_00000000000000",
        "type": "invoice.payment_succeeded",
        "object": "event",
        "request": null,
        "pending_webhooks": 1,
        "api_version": "2014-12-22",
        "data": {
          "object": {
            "id": "in_00000000000000",
            "object": "invoice",
            "amount_due": 2000,
            "application_fee": null,
            "attempt_count": 1,
            "attempted": true,
            "billing": "charge_automatically",
            "charge": "_00000000000000",
            "closed": true,
            "currency": "gbp",
            "customer": "cus_00000000000000",
            "date": 1440800213,
            "description": null,
            "discount": null,
            "due_date": null,
            "ending_balance": 0,
            "forgiven": false,
            "lines": {
              "data": [
                {
                  "id": "sub_7RRg5VXUXhqzf8",
                  "object": "line_item",
                  "amount": 4000,
                  "currency": "gbp",
                  "description": null,
                  "discountable": true,
                  "livemode": true,
                  "metadata": {
                  },
                  "period": {
                    "start": 1517246209,
                    "end": 1519838209
                  },
                  "plan": {
                    "id": "gold",
                    "object": "plan",
                    "amount": 6000,
                    "created": 1440601029,
                    "currency": "gbp",
                    "interval": "month",
                    "interval_count": 1,
                    "livemode": false,
                    "metadata": {
                    },
                    "name": "Gold",
                    "statement_descriptor": null,
                    "trial_period_days": null
                  },
                  "proration": false,
                  "quantity": 1,
                  "subscription": null,
                  "subscription_item": "si_18TXp245xIsfugESbzziU9ar",
                  "type": "subscription"
                }
              ],
              "has_more": false,
              "object": "list",
              "url": "/v1/invoices/in_16ev9V45xIsfugESrFGXSYxm/lines"
            },
            "livemode": false,
            "metadata": {
            },
            "next_payment_attempt": null,
            "number": null,
            "paid": true,
            "period_end": 1440800213,
            "period_start": 1440800213,
            "receipt_number": null,
            "starting_balance": 0,
            "statement_descriptor": null,
            "subscription": "sub_00000000000000",
            "subtotal": 2000,
            "tax": null,
            "tax_percent": null,
            "total": 2000,
            "webhooks_delivered_at": 1440800213,
            "payment": "ch_00000000000000"
          }
        }
      }';
      echo "<pre>";
         $event_json = json_decode($input);
         print_r($event_json->data);
         $status='';
         $amount=4000;
         $billing=$event_json->data->object->billing; //charge_automatically
         $customer_id=$event_json->data->object->customer;
         print_r($event_json->data->object->customer);
        
        file_put_contents('storage/filename.txt', print_r($event_json,true));
        // Do something with $event_json
        http_response_code(200); // PHP 5.4 or greater
    }
}
