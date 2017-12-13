<?php
namespace App\Http\Controllers;
use DB;
use App;
use Illuminate\Http\Request;
use Route;
use Mail;
use File;
use App\Mail\registrationMail;
class HomeController extends Controller
{
    public function index()
	{
		$data = array();
		$fetch_category = DB::table(TBL_JOB_CATEGORY)->where('category_status',1)->get();
		$fetch_job_type = DB::table(TBL_JOB_TYPE)->where('job_type_status',1)->get();
		$data['category'] = $fetch_category;
		$data['job_type'] = $fetch_job_type;		
		return view('home',$data);
	}
	public function post_job(Request $request)
	{
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
			if(session()->get('user_id'))
			{
				$insert['user_id'] = session()->get('user_id');
			}
			else
			{
				$insert['user_id'] = 0;
			}
			$job_id = DB::table(TBL_JOB_POST)->insertGetId($insert);
			session()->put('job_id',$job_id);
			
			if($request->hasFile('attachment'))
			{
				foreach($request->file('attachment') as $attachment)
				{
					if(!empty($attachment))
					{
						$destinationPath = 'attachment/';
						$filename = time().".".$attachment->getClientOriginalName();
						$attachment->move($destinationPath, $filename);
					
						$job_insert_attachment = array(
							'attachment_name' => $filename,
							'job_id' =>$job_id
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
				return redirect('my-posted');
			}
			else
			{
				return redirect('signup');
			}
		}
	}
	public function signup(Request $request)
	{
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
			DB::table(TBL_JOB_POST)->where('job_id',session()->get('job_id'))->update($update_job);
			session()->put('job_id','');
			session()->put('mobile_vcode',$m_code);
			$request->user_id=$user_id;
			$request->v_code=$e_code;
			Mail::send(new registrationMail());
			return redirect('verification');
		}
		return view('signup');
	}
	public function verification(Request $request){	
		if(@$request->all())
		{
			$validation = array();
			$validation['code']='required';
			$this->validate($request,$validation);
			$get = DB::table(TBL_USER)->where('phone_vcode',$request->code)->first();
			if(count($get)>0)
			{
				$update = array();
				$update['phone_vcode'] = null;
				$update['is_phone_verified'] = 1;
				DB::table(TBL_USER)->where('user_id',$get->user_id)->update($update);
				session()->put('mobile_vcode','');
				session()->flash('success','Phone Verification successfully done.');
				return redirect('login');
			}
			else
			{
				return redirect('login');
			}
		}
		return view('message');
	}
	public function verifiy($key){
		if(@$key){
		$vcode=explode('_',$key);
		$get_user = DB::table(TBL_USER)->where('user_id',$vcode[1])->first();
			if(@$get_user && $get_user->email_vcode != ""){
				if(@$get_user->user_type == 3){
					if($get_user->user_status == 0 && $get_user->email_vcode != ""){
						$update = array();
						$update['user_status']=1;
						$update['email_vcode']=null;
						$update['is_email_verified']=1;
						DB::table(TBL_USER)->where('user_id',$vcode[1])->update($update);
						session()->put('message','mail-verification');
						return redirect('verification');
					}else{
						return redirect('login');
					}
				}
				if(@$get_user->user_type == 2){
					if($get_user->user_status == 0 && $get_user->email_vcode != ""){
						$update = array();
						$update['user_status']=1;
						$update['email_vcode']=null;
						$update['is_email_verified']=1;
						DB::table(TBL_USER)->where('user_id',$vcode[1])->update($update);
						session()->put('message','mail-verification');
						return redirect('verification');
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
	public function identity_verification(Request $request)
	{
		if(session()->get('registration_id') == "")
		{
			return redirect('tradesmen-signup');
		}
		if(@$request->all())
		{
			$validation = array();
			$validation['code']='required';
			$this->validate($request,$validation);
			//echo $request->code;die;
			$get = DB::table(TBL_USER)->where('phone_vcode',$request->code)->first();
			if(@$get)
			{
				$update = array();
				$update['phone_vcode'] = null;
				$update['is_phone_verified'] = 1;
				DB::table(TBL_USER)->where('user_id',$get->user_id)->update($update);
				session()->put('mobile_code','');
				session()->put('registration_id','');
				return redirect('payment');
			}
			else
			{
				$m_code = rand('0000','9999');
				$update = array('phone_vcode'=>$m_code);
				DB::table(TBL_USER)->where('user_id',session()->get('registration_id'))->update($update);
				session()->put('mobile_code',$m_code);
				return redirect('identity-verification');
			}
		}
		return view('tradesmen_verification');
	}
	public function payment(Request $request)
	{
		return view('tradesmen_payment');
	}
	public function exist_mail(Request $request)
	{
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
	public function exist_mobile(Request $request)
	{
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
	public function login(Request $request)
	{
		//echo "<pre>";print_r($request->all());die;
		if(@$request->all())
		{	//echo md5($request->password);die;
			$details = DB::table(TBL_USER)->where('email',$request->email)->where('password',md5($request->password))->where('user_type','!=',1)->first();
			if(count($details)>0)
			{
				if($details->is_email_verified == 1 && $details->is_phone_verified == 1 && $details->user_status == 1)
				{
					session()->put('user_id',$details->user_id);
					session()->put('user_type',$details->user_type);
					if($details->user_type == 3)
					{
						return redirect('my-posted');
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
					session()->flash('msg','Please verify your mobile first.');
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
	public function tradesmen(Request $request)
	{
		return view('tradesmen');
	}
	public function tradesmen_signup(Request $request)
	{
		$data = array();
		//echo "<pre>";print_r($request->all());
		if(session()->get('registration_id') != "")
		{
			$get_user = DB::table(TBL_USER)->where('user_id',session()->get('registration_id'))->first();
			//echo "<pre>";print_r($get_user);die;
			$data['user'] = $get_user;
		}
		if(@$request->all())
		{
			if(session()->get('registration_id') != "")
			{
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
				$this->validate($request,$validation);
				$insert = array();
				//$e_code = rand('000000','999999');
				$m_code = rand('0000','9999');
				$insert['sur_name'] = $request->sur_name;
				$insert['user_name'] = $request->user_name;
				$insert['business_role'] = $request->business_role;
				$insert['company_name'] = $request->company_name;
				$insert['primary_trade'] = $request->primary_trade;
				$insert['business_type'] = $request->business_type;
				$insert['mobile'] = $request->mobile;
				$insert['post_code'] = $request->post_code;
				$insert['address'] = $request->address;
				$insert['lattitude'] = $request->lattitude;
				$insert['longitude'] = $request->longitude;
				//$insert['email_vcode'] = $e_code;
				$insert['phone_vcode'] = $m_code;
				DB::table(TBL_USER)->where('user_id',session()->get('registration_id'))->update($insert);				
				$search  = array('!', '@', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>');
				$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ');
				$name = trim($insert['user_name']);	
				$len=strlen($name);
				$resource_slug=str_replace($search, $replace, $name);
				$resource_slug=str_replace(' ','-',$resource_slug);
				for($i=0;$i<=$len;$i++)
				{
					$resource_slug=str_replace('--','-',$resource_slug);
					$resource_slug=strtolower($resource_slug);
				}
				$slug_array = array();
				$slug_array['user_slug'] = "tradesmen-".$resource_slug;
				$check = DB::table(TBL_USER)->where('user_slug',$slug_array)->get();
				if(count($check)>0){
					$resource_slug="tradesmen-".$resource_slug."-".session()->get('registration_id');
				}else{
					$resource_slug="tradesmen-".$resource_slug;
				}
				$update_slug=array();
				$update_slug['user_slug']=$resource_slug;
				DB::table(TBL_USER)->where('user_id',session()->get('registration_id'))->update($update_slug);
			}
			else
			{
				$validation = array();
				$validation['sur_name']='required';
				$validation['user_name']='required';
				$validation['business_role']='required';
				$validation['email']='required';
				$validation['company_name']='required';
				$validation['primary_trade']='required';
				$validation['business_type']='required';
				$validation['mobile']='required';
				$validation['post_code']='required';
				$validation['address']='required';
				$validation['password']='required';
				$validation['lattitude']='required';
				$validation['longitude']='required';
				$this->validate($request,$validation);
				$insert = array();
				$e_code = rand('000000','999999');
				$m_code = rand('0000','9999');
				$insert['sur_name'] = $request->sur_name;
				$insert['user_name'] = $request->user_name;
				$insert['business_role'] = $request->business_role;
				$insert['email'] = $request->email;
				$insert['company_name'] = $request->company_name;
				$insert['primary_trade'] = $request->primary_trade;
				$insert['business_type'] = $request->business_type;
				$insert['mobile'] = $request->mobile;
				$insert['post_code'] = $request->post_code;
				$insert['address'] = $request->address;
				$insert['lattitude'] = $request->lattitude;
				$insert['longitude'] = $request->longitude;
				$insert['password'] = md5($request->password);
				$insert['email_vcode'] = $e_code;
				$insert['phone_vcode'] = $m_code;
				$insert['registration_date'] = date('Y-m-d H:i:s');
				$insert['user_type'] = 2;
				$insert['user_status'] = 0;
				$insert_id = DB::table(TBL_USER)->insertGetId($insert);				
				$search  = array('!', '@', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>');
				$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ');
				$name = trim($insert['user_name']);	
				$len=strlen($name);
				$resource_slug=str_replace($search, $replace, $name);
				$resource_slug=str_replace(' ','-',$resource_slug);
				for($i=0;$i<=$len;$i++)
				{
					$resource_slug=str_replace('--','-',$resource_slug);
					$resource_slug=strtolower($resource_slug);
				}
				$slug_array = array();
				$slug_array['user_slug'] = "tradesmen-".$resource_slug;
				$check = DB::table(TBL_USER)->where('user_slug',$slug_array)->get();
				if(count($check)>0){
					$resource_slug="tradesmen-".$resource_slug."-".$insert_id;
				}else{
					$resource_slug="tradesmen-".$resource_slug;
				}
				$update_slug=array();
				$update_slug['user_slug']=$resource_slug;
				DB::table(TBL_USER)->where('user_id',$insert_id)->update($update_slug);
				$request->user_id=$insert_id;
				$request->v_code=$e_code;
				session()->put('registration_id',$insert_id);
				Mail::send(new registrationMail());
			}
			session()->put('mobile_code',$m_code);
			return redirect('identity-verification');
		}
		$fetch_category = DB::table(TBL_JOB_CATEGORY)->where('category_status',1)->get();
		$data['category'] = $fetch_category;
		return view('tradesmen_signup',$data);
	}
	public function forget_password(Request $request){
		if(@$request->all()){
			$validation = array();
			$validation['email'] = 'required';
			$this->validate($request,$validation);
			$fetch_email = DB::table(TBL_USER)->where('email',$request->email)->where('user_status','!=',4)->first();
			if(count($fetch_email)>0)
			{
				$data = array();
				$data['id'] = md5($fetch_email->user_id);
				$data['user_name'] = $fetch_email->user_name;
				$data['email'] = $request->email;
				//$data['reset_url'] = 'reset-password/'.$data['id'];
				//Mail::send(new sendMail($data));
				session()->flash('success','A reset password link has been sent to your email address.Please check your email and reset your password.');
				return redirect('forget-password');
			}
			else
			{
				session()->flash('msg','Opps! something went wrong.');
				return redirect('forget-password');
			}
		}
		return view('forget_password');
	}
	public function logout(){
		session()->put('user_id','');
		session()->put('user_type','');
		session()->flash('msg','You have successfully logout.');
		return redirect('login');
	}
	public function my_posted()
	{
		if(session()->get('user_type') == 3)
		{
			$data = array();
			$fetch_job = DB::table(TBL_JOB_POST)->select(TBL_JOB_POST.'.*',TBL_JOB_CATEGORY.'.category_name',TBL_JOB_CATEGORY.'.category_id',TBL_JOB_TYPE.'.job_type_name')
			->leftJoin(TBL_JOB_TO_CATEGORY,TBL_JOB_POST.'.job_id','=',TBL_JOB_TO_CATEGORY.'.job_id')
			->leftJoin(TBL_JOB_CATEGORY,TBL_JOB_TO_CATEGORY.'.category_id','=',TBL_JOB_CATEGORY.'.category_id')
			
			->leftJoin(TBL_JOB_TYPE,TBL_JOB_POST.'.job_type_id','=',TBL_JOB_TYPE.'.job_type_id')
			->where('user_id',session()->get('user_id'))
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
	public function edit_job_posted(Request $request,$id)
	{
		$get_job = DB::table(TBL_JOB_POST)->where('job_id',$id)->first();
		if(count($get_job)>0 && $get_job->user_id == session()->get('user_id'))
		{
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
				$insert['looking_for'] = $request->looking_for;
				$insert['budget'] = $request->budget;
				$insert['deadline'] = date('y-m-d',strtotime($request->deadline));
				$insert['city'] = $request->city;
				$insert['lattitude'] = $request->lattitude;
				$insert['longitude'] = $request->longitude;
				$insert['zip_code'] = $request->zip_code;
				$insert['job_details'] = $request->job_details;
				DB::table(TBL_JOB_POST)->where('job_id',$id)->update($insert);
				$job_inser_cat = array(
				'category_id' => $request->job_category_id
				);
				DB::table(TBL_JOB_TO_CATEGORY)->where('job_id',$id)->update($job_inser_cat);
				session()->put('edit','success');
				return redirect('my-posted');
			}
		}
		else
		{
			return redirect('my-posted');
		}
	}
}
