<?php
namespace App\Http\Controllers;
use DB;
use App;
use Illuminate\Http\Request;
use Route;
use Mail;
use File;
use Artisan;
use App\Package;
use App\Mail\registrationMail;
use Plivo;
class HomeController extends Controller
{
    public function index(){		
		if(session()->get('user_id') !=""){
			if(session()->get('user_type') == 3)
			{
				return redirect('my-jobs');
			}
			else
			{
				return redirect('my-profile');
			}
		}
		$data = array();
		$fetch_category = DB::table(TBL_JOB_CATEGORY)->where('category_status',1)->get();
		$fetch_job_type = DB::table(TBL_JOB_TYPE)->where('job_type_status',1)->get();
		$data['category'] = $fetch_category;
		$data['job_type'] = $fetch_job_type;		
		return view('home',$data);
	}
	public function signup(Request $request){
		//echo session()->get('job_id');die;
		if(@$request->all())
		{
			$validation = array();
			$validation['email']='required';
			$validation['user_name']='required';
			$validation['user_mobile']='required';
			$validation['password']='required';
			$this->validate($request,$validation);
			$insert = array();
			$e_code = rand('000000','999999');
			$m_code = rand('0000','9999');
			$insert['user_name'] = $request->user_name;
			$insert['email'] = $request->email;
			$insert['mobile'] = $request->user_mobile;
			$insert['password'] = md5($request->password);
			$insert['email_vcode'] = $e_code;
			$insert['phone_vcode'] = $m_code;
			$insert['registration_date'] = date('Y-m-d H:i:s');
			$insert['user_type'] = 3;
			$insert['user_status'] = 0;
			$user_id = DB::table(TBL_USER)->insertGetId($insert);
			$update_job = array(
				'user_id' =>$user_id,
				'job_status' =>1
			);
			//send verification code for mobile 
			$twillio_obj=new TwilioController();
			$twillio_obj->sendMobileVerificationCodeForCustomerRegistration($insert['phone_vcode'], $request->user_mobile);
			//
			DB::table(TBL_JOB_POST)->where('job_id',session()->get('job_id'))->update($update_job);
			session()->put('job_id','');
			session()->put('mobile_code',$m_code);
			session()->put('message_mobile_verification','mobile-verification');
			session()->put('message','mail-verification');
			
			$request->user_id=$user_id;
			$request->v_code=$e_code;
			Mail::send(new registrationMail());
			return redirect('verification');
		}
		return view('signup');
	}
	//verify mobile
	public function verification(Request $request){	
		if(@$request->all()){
			$validation = array();
			$validation['code']='required';
			$this->validate($request,$validation);
			$notPhoneVerified = DB::table(TBL_USER)
					->where('phone_vcode',$request->code)
					->first();					
			if(count($notPhoneVerified)>0){	
				$this->verifyMobile($request->code);
				$this->update_user_status($notPhoneVerified->user_id);
				session()->put('mobile_code','');				
				session()->put('message_mobile_verification','');
				session()->flash('success','Phone Verification successfully done.');
				return redirect('login');
			}else{
				return view('message');
			}
		}
		if(session()->get('mobile_verification_user_id')){
            session()->put('message_mobile_verification', 'mobile-verification');
		}	
		return view('message');
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
	//verify email
	public function verifiy($key){
		if(@$key){	
		$get_user = DB::table(TBL_USER)->where('email_vcode',$key)->first();		
			if(@$get_user && $get_user->email_vcode != ""){
				if(@$get_user->user_type == 3){
					if($get_user->user_status == 0 && $get_user->email_vcode != ""){
						$update = array();
						if($get_user->phone_vcode =="" && $get_user->is_phone_verified == 1){
							$update['user_status']=1;
						}else{
							$update['user_status']=0;
						}
						$update['email_vcode']=null;
						$update['is_email_verified']=1;
						DB::table(TBL_USER)->where('user_id',$get_user->user_id)->update($update);					
						session()->flash('message','mail-verified');
						return redirect('verification');
					}else{
						return redirect('login');
					}
				}
				if(@$get_user->user_type == 2){
					if($get_user->user_status == 0 && $get_user->email_vcode != ""){
						$update = array();
						if($get_user->phone_vcode =="" && $get_user->is_phone_verified == 1)
						{
							$update['user_status']=1;
						}else{
							$update['user_status']=0;
						}
						$update['email_vcode']=null;
						$update['is_email_verified']=1;
						 DB::table(TBL_USER)->where('email_vcode',$key)->update($update);
						//session()->put('message','mail-verification');
						session()->put('registration_id',$get_user->user_id);
						return redirect('identity-verification');
					}else{
						return redirect('login');
					}
				}else{
					session()->put('message','expired_link');
					return redirect('login');
				}
			}else{
				session()->put('message','expired_link');
				return redirect('verification');
			}
		}
	}
	public function exist_mail(Request $request){
		$check_email = DB::table(TBL_USER)->where('email',trim($request->email))->get();
		if(count($check_email)>0)
		{
			$responce = array('msg'=>1);
		}
		else
		{
			$responce = array('msg'=>2);
		}
		echo json_encode($responce);
	}
	public function exist_mobile(Request $request){
		$check_mobile = DB::table(TBL_USER)->where('mobile',trim($request->mobile))->get();
		if(count($check_mobile)>0)
		{
			$responce = array('msg'=>1);
		}
		else
		{
			$responce = array('msg'=>2);
		}
		echo json_encode($responce);
	}
	public function exist_mobile_number(Request $request){
		$check_mobile = DB::table(TBL_USER)->where('mobile',trim($request->mobile))->where('user_id','!=',session()->get('user_id'))->get();
		if(count($check_mobile)>0)
		{
			$responce = array('msg'=>1);
		}
		else
		{
			$responce = array('msg'=>2);
		}
		echo json_encode($responce);
	}
	public function login(Request $request){
		
		if(@$request->all())
		{	//echo md5($request->password);die;
			
			$details = DB::table(TBL_USER)
						->where('email',$request->email)
						->where('password',md5($request->password))
						->where('user_type','!=',1)
						->first();		
			if(count($details)>0)
			{
               
				if($details->is_email_verified == 1 && $details->is_phone_verified == 1 && $details->user_status == 1)
				{
					session()->put('user_id',$details->user_id);
					session()->put('user_type',$details->user_type);
					if($details->user_type == 3)
					{
						return redirect('my-jobs');
					}
					if($details->user_type == 2)
					{
						return redirect('my-profile');
					}
				}
				if($details->is_email_verified == 0 && $details->email_vcode != "")
				{
					session()->flash('msg','Please verify your email first.');
					return redirect('login');
				}
				if($details->is_phone_verified == 0 && $details->phone_vcode != "")
				{
					$mobile_verify_link='<a href="'.url('verification').'">Click</a>';             
					session()->flash('msg',$mobile_verify_link.' here to verify your mobile.');	
					session()->put('mobile_verification_user_id',$details->user_id);				
					return redirect('login');
				}
				if($details->is_phone_verified == 0 && $details->is_email_verified == 0)
				{
					session()->flash('msg','Please verify your mobile and email first.');
					return redirect('login');
				}
				else
				{
					session()->flash('msg','You are not active user.');
					return redirect('login');
				}
			}
			else
			{
				session()->flash('msg','Invalid login credential.');
				return redirect('login');
			}
		}
		return view('login');
	}
	public function tradesmen(Request $request){
		return view('tradesmen');
	}
	
	public function logout(){
		session()->put('user_id','');
		session()->put('user_type','');
		session()->flash('msg','You have successfully logout.');
		return redirect('login');
	}
	public function post_job(Request $request){
		if(@$request->all()){          			
			$validation = array();
			$validation['job_type_id']='required';
			$validation['job_category_id']='required';
			$validation['looking_for']='required';
			$validation['budget']='required';
			$validation['deadline']='required';
			$validation['city']='required';
			$validation['zip_code']='required';
			$validation['job_details']='required';
			$validation['lattitude']='required';
			$validation['longitude']='required';			
			$this->validate($request,$validation);
			$insert = array();
			$insert['job_type_id'] = $request->job_type_id;
			//$insert['job_category_id'] = $request->job_category_id;
			$insert['looking_for'] = $request->looking_for;
			$insert['budget'] = $request->budget;
			$insert['deadline'] = date('y-m-d',strtotime($request->deadline));
			$insert['city'] = $request->city;
			$insert['lattitude'] = $request->lattitude;
			$insert['longitude'] = $request->longitude;
			$insert['zip_code'] = $request->zip_code;
			$insert['job_details'] = $request->job_details;
			$insert['exp_date'] = date('y-m-d',strtotime('+30 days',time())); //by default job expiry date will be 30 days from posted date
			if(session()->get('user_id')){
				$insert['user_id'] = session()->get('user_id');
			}else{
				$insert['user_id'] = 0;
			}
			$job_id = DB::table(TBL_JOB_POST)->insertGetId($insert);
			session()->put('job_id',$job_id);			
			if($request->hasFile('attachment')){
				foreach($request->file('attachment') as $attachment){
					if(!empty($attachment)){
						$destinationPath = 'attachment/';
						$original_name=$attachment->getClientOriginalName();
						$filename = time().".".$attachment->getClientOriginalExtension();
						$attachment->move($destinationPath, $filename);
						
						$job_insert_attachment = array(
							'attachment_name' => $filename,
							'job_id' =>$job_id,
							'orginal_name' =>$original_name
						);
						DB::table(TBL_JOB_TO_ATTACHMENT)->insert($job_insert_attachment);
					}
				}
			}
			$job_inser_cat = array(
				'category_id' => $request->job_category_id,
				'job_id' =>$job_id
			);
			DB::table(TBL_JOB_TO_CATEGORY)->insert($job_inser_cat);
			if(session()->get('user_id'))
			{
				session()->flash('success','Job Posted Successfully.'); 
				return redirect('my-jobs');
			}
			else
			{
				return redirect('signup');
			}
		}
	}
	public function my_posted(){
		if(session()->get('user_type') == 3)
		{
			$data = array();
			$fetch_job = DB::table(TBL_JOB_POST)->select(TBL_JOB_POST.'.*',TBL_JOB_CATEGORY.'.category_name',TBL_JOB_CATEGORY.'.category_id',TBL_JOB_TYPE.'.job_type_name')
			->leftJoin(TBL_JOB_TO_CATEGORY,TBL_JOB_POST.'.job_id','=',TBL_JOB_TO_CATEGORY.'.job_id')
			->leftJoin(TBL_JOB_CATEGORY,TBL_JOB_TO_CATEGORY.'.category_id','=',TBL_JOB_CATEGORY.'.category_id')
			
			->leftJoin(TBL_JOB_TYPE,TBL_JOB_POST.'.job_type_id','=',TBL_JOB_TYPE.'.job_type_id')
			->where('user_id',session()->get('user_id'))
			->where('job_status','!=',3)
			->where('job_status','!=',5)
			->where('job_status','!=',4)
			->get();
			$fetch_category = DB::table(TBL_JOB_CATEGORY)->where('category_status',1)->get();
			$fetch_job_type = DB::table(TBL_JOB_TYPE)->where('job_type_status',1)->get();
			//echo "<pre>";print_r($fetch_job);die;
			$data['get_job'] = $fetch_job;
			$data['category'] = $fetch_category;
			$data['job_type'] = $fetch_job_type;
			return view('my_posted',$data);
		}
		else
		{
			
		}
	}
	public function delete_job($id){
		$fetch = DB::table(TBL_JOB_POST)->where('job_id',$id)->first();
		if(count($fetch)>0 && $fetch->user_id == session()->get('user_id'))
		{
			//$update = array('job_status'=>5);
			DB::table(TBL_JOB_POST)->where('job_id',$id)->update(array('job_status'=>5));
			session()->flash('success','Job deleted successfully.');
			return redirect('my-jobs');
		}
	}
	public function edit_job_posted(Request $request,$id){
		$get_job = DB::table(TBL_JOB_POST)->where('job_id',$id)->first();
		if(count($get_job)>0 && $get_job->user_id == session()->get('user_id'))
		{
			//echo "<pre>";print_r($request->all());die;
			if(@$request->all()){
				$validation = array();
				$validation['job_type_id']='required';
				$validation['job_category_id']='required';
				$validation['looking_for']='required';
				$validation['budget']='required';
				$validation['deadline']='required';
				$validation['city']='required';
				$validation['zip_code']='required';
				$validation['job_details']='required';
				//$validation['lattitude']='required';
				//$validation['longitude']='required';
				$this->validate($request,$validation);
				$insert = array();
				$insert['job_type_id'] = $request->job_type_id;
				$insert['looking_for'] = $request->looking_for;
				$insert['budget'] = $request->budget;
				$insert['deadline'] = date('Y-m-d',strtotime($request->deadline));
				$insert['city'] = $request->city;
				$insert['lattitude'] = $request->lattitude;
				$insert['longitude'] = $request->longitude;
				$insert['zip_code'] = $request->zip_code;
				$insert['job_details'] = $request->job_details;
				DB::table(TBL_JOB_POST)->where('job_id',$id)->update($insert);
				if($request->hasFile('attachment'))
				{
					//echo"ok";die;
					DB::table(TBL_JOB_TO_ATTACHMENT)->where('job_id',$id)->delete();
					foreach($request->file('attachment') as $attachment)
					{
						if(!empty($attachment))
						{
							$destinationPath = 'attachment/';
							$original_name=$attachment->getClientOriginalName();
							$filename = time().".".$attachment->getClientOriginalExtension();
							$attachment->move($destinationPath, $filename);
							
							$job_insert_attachment = array(
								'attachment_name' => $filename,
								'job_id' =>$id,
								'orginal_name' =>$original_name
							);
							DB::table(TBL_JOB_TO_ATTACHMENT)->insert($job_insert_attachment);
						}
					}
				}
				$job_inser_cat = array(
				'category_id' => $request->job_category_id
				);
				DB::table(TBL_JOB_TO_CATEGORY)->where('job_id',$id)->update($job_inser_cat);
				session()->flash('success','Job Edited Successfully.'); 
				return redirect('my-jobs');
			}
		}
		else
		{
			return redirect('my-jobs');
		}
	}
	public function job_attachment(Request $request){
		$get_attachment = DB::table(TBL_JOB_TO_ATTACHMENT)->where('job_id',$request->job_id)->get();
		if(count($get_attachment)>0)
		{
			$msg='';
			foreach($get_attachment as $attachment)
			{
				$url = url('attachment/'.$attachment->attachment_name);
				
				$msg.='<div class="attac_area" id="attach_file_'.$attachment->attachment_id.'"><a href="'.$url.'" download="'.$attachment->orginal_name.'">'.$attachment->orginal_name.'</a><span style="cursor:pointer;" data-id='.$attachment->attachment_id.' title="Delete Attachment" class="delete_attachment"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			}
			$responce = array('attach'=>$msg);
		}
		else
		{
			$responce = array('attach'=>'no');
		}
		echo json_encode($responce);
	}
	public function delete_attachment(Request $request){
		DB::table(TBL_JOB_TO_ATTACHMENT)->where('attachment_id',$request->attachment_id)->delete();
		$responce = array('delete'=>1);
		echo json_encode($responce);
	}
	public function edit_profile(Request $request){
		if(session()->get('user_id') !="" && session()->get('user_type') == 3)
		{
			$get_user = DB::table(TBL_USER)->select('user_name','mobile','email','working_hours')->where('user_id',session()->get('user_id'))->first();
			if(@$request->all()){
				$update = array(
				'user_name'=>$request->user_name,
				'mobile'=>$request->mobile,
				'working_hours'=>$request->from_time.'-'.$request->to_time				
				);				
				if(@$request->password) $update['password']=md5($request->password);				
				DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->update($update);
				session()->flash('success',' Profile successfully updated.');
				return redirect('edit-profile');
			}
			$data = ['user'=>$get_user];
			return view('customer_edit_profile',$data);
		}else{
			if(session()->get('user_type') == 3){
				return redirect('my-jobs');
			}else{
				return redirect('my-profile');
			}
		}
	}
	public function static_page($slug){
		//echo $slug;
		$get_page = DB::table(TBL_STATIC_PAGE)->where('page_slug',$slug)->first();
		//return $get_page;die;
		$data['page'] = $get_page;
		//echo "<pre>";print_r($get_page);die;
		return view('static_page',$data);
	}
	public function verify_identity(Request $request){

	}
	//if both email and phone verification done update the user as active user
	public function update_user_status($user_id){
		$checkUser=	DB::table(TBL_USER)
					->where('is_email_verified',1)
					->where('is_phone_verified',1)
					->where('user_id',$user_id)
					->first();
		if(count($checkUser)){
			$update['user_status'] = 1;
				  DB::table(TBL_USER)
				  ->where('user_id',$user_id)
				  ->update($update);
		}			
	}

}
