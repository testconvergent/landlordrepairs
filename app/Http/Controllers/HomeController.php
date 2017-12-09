<?php
namespace App\Http\Controllers;
use DB;
use App;
use Illuminate\Http\Request;
use Route;
use Mail;
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
			$job_id = DB::table(TBL_JOB_POST)->insertGetId($insert);
			session()->put('job_id',$job_id);
			$job_inser_cat = array(
				'category_id' => $request->job_category_id,
				'job_id' =>$job_id
			);
			DB::table(TBL_JOB_TO_CATEGORY)->insert($job_inser_cat);
			return redirect('signup');
		}
	}
	public function signup(Request $request)
	{
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
			$request->user_id=$user_id;
			$request->v_code=$e_code;
			Mail::send(new registrationMail());
		}
		return view('signup');
	}
	public function verification(Request $request){		
		/* if(session()->get('message') == ""){
			return redirect('login');
		}
		$data['message'] = session()->get('message');
		session()->put('message',''); */
		if(@$request->all())
		{
			$validation = array();
			$validation['code']='required';
			$this->validate($request,$validation);
			$get = DB::table(TBL_USER)->where('phone_vcode',$request->code)->first();
			if(@$get)
			{
				$update = array();
				$update['phone_vcode'] = null;
				$update['is_phone_verified'] = 1;
				DB::table(TBL_USER)->where('user_id',$get->user_id)->update($update);
				return redirect('login');
			}
			else
			{
				
			}
		}
		return view('message');
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
					return redirect('dashboard');
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
}
