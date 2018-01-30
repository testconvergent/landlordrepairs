<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Package;
use App\Mail\registrationMail;
use DB;
use Mail;
class TradesmanSignUpController extends Controller
{
    // Tradesman sigh up process //Step 1
	public function tradesmen_signup(Request $request){		
		if ($request->isMethod('post')) {			
				$validation = array();
				$validation['sur_name']='required';
				$validation['user_name']='required';
				$validation['business_role']='required';
				$validation['company_name']='required';
				$validation['primary_trade']='required';
				$validation['business_type']='required';
				$validation['mobile']='required';
				$validation['post_code']='required';
				$validation['address']='required';
				$validation['lattitude']='required';
                $validation['longitude']='required';
                $validation['password']='required';
                			
				$this->validate($request,$validation);
				
				$insert = array();			
                $m_code = rand('0000','9999');
                $email_code = md5(rand('0000','9999'));
				$insert['sur_name'] = $request->sur_name;
                $insert['user_name'] = $request->user_name;
                $insert['password'] =md5($request->password);;
				$insert['business_role'] = $request->business_role;
				$insert['company_name'] = $request->company_name;
				$insert['primary_trade'] = $request->primary_trade;
				$insert['business_type'] = $request->business_type;
				$insert['mobile'] = $request->mobile;
				$insert['post_code'] = $request->post_code;
				$insert['address'] = $request->address;
				$insert['lattitude'] = $request->lattitude;
				$insert['longitude'] = $request->longitude;
                $insert['email'] = $request->email; 
                $insert['user_type'] =2;               
                $insert['email_vcode'] =$email_code;
                $insert['phone_vcode'] = $m_code;
                $insert['registration_date'] = Date('Y-m-d H:i:s');
                //Send this verification code the mobile number
                $twillio_obj=new TwilioController();
                $twillio_obj->sendMobileVerificationCodeForTradesmanRegistration($insert['phone_vcode'], $request->mobile);
                //               
                $insert['user_slug'] = "tradesmen-".str_slug($request->user_name);				
                $insert_id = DB::table(TBL_USER)->insertGetId($insert);	
                session()->put('registration_id', $insert_id);
                $request->v_code= $email_code;
				Mail::send(new registrationMail());
				session()->put('mobile_code',$m_code);
				return redirect('identity-verification');
			}
		$fetch_category = DB::table(TBL_JOB_CATEGORY)->where('category_status',1)->get();
		$data['category'] = $fetch_category;
		return view('tradesmen_signup',$data);
	}
	//Tradesman sigh up process Step 2
	public function identity_verification(Request $request){
        if(session()->get('registration_id')){
            if ($request->isMethod('post')){
                $validation = array();
                $validation['code']='required';
                $this->validate($request,$validation);
                $mcode=$request->code;
                $this->verifyMobile($mcode);                
            }
            if($this->isMobileVerified() && $this->isEmailVerified()) {
                //update the user as active user 
                    DB::table(TBL_USER)
                    ->where('user_id',session()->get('registration_id'))
                    ->update(array('user_status'=>1));         
                return redirect('payment');			
            }
            if(!$this->isEmailVerified()){
                session()->put('email_not_verified','not_verified'); 
            }else{
                session()->put('email_not_verified',''); 
            }
            if(!$this->isMobileVerified()){
                session()->put('mobile_not_verified','not_verified'); 
            }else{
                session()->put('mobile_not_verified','');
                session()->put('mobile_code','');
            }           
            return view('tradesmen_verification');
        }else{           
            return redirect('tradesmen-signup');
        }
	}
    //Tradesman sigh up process //Step 3
	public function payment(Request $request){
            if(session()->get('registration_id')){
                $creditPackageDetails= Package::where('package_status',1)->where('package_type',2)->get();
                $memberPackageDetails= Package::where('package_status',1)->where('package_type',1)->first();
                return view('tradesmen_payment',compact('creditPackageDetails','memberPackageDetails'));    
            }else{
                return redirect('tradesmen-signup');
            }
              
    }   
    public function isEmailVerified(){
         $emailVerified=DB::table(TBL_USER)
                       ->where('user_id',session()->get('registration_id'))
                       ->where('is_email_verified',1)
                       ->first();
        if(count($emailVerified)){            
            return 'true';
        }
    }
    public function isMobileVerified(){
        $emailVerified=DB::table(TBL_USER)
                      ->where('user_id',session()->get('registration_id'))
                      ->where('is_phone_verified',1)
                      ->first();        
      
       if(count($emailVerified)){            
           return 'true';
       }
   }
   public function verifyMobile($mcode){
      $mobile_verified=DB::table(TBL_USER)
                            ->where('phone_vcode',$mcode)
                            ->first();
      if(count($mobile_verified)){
          $update['is_phone_verified'] = 1;
          $update['phone_vcode'] = null;
                DB::table(TBL_USER)
                ->where('user_id',$mobile_verified->user_id)
                ->update($update);
      }
   }
    public function verification(Request $request){	
		if(@$request->all()){
			$validation = array();
			$validation['code']='required';
			$this->validate($request,$validation);
			$get = DB::table(TBL_USER)->where('phone_vcode',$request->code)->first();
			if(count($get)>0){
				$update = array();
				$update['phone_vcode'] = null;
				if($get->email_vcode =="" && $get->is_email_verified == 1){
					$update['user_status']=1;
				}
				else{
					$update['user_status']=0;
				}
				$update['is_phone_verified'] = 1;
				DB::table(TBL_USER)->where('user_id',$get->user_id)->update($update);
				session()->put('mobile_vcode','');
				session()->flash('success','Phone Verification successfully done.');
				return redirect('login');
			}else{
				return redirect('login');
			}
		}
		return view('message');
	}
}
