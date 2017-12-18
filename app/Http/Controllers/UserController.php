<?php
namespace App\Http\Controllers;
use DB;
use App;
use App\User;
use App\Jobs;
use App\UsersToPortFolio;
//use Image;
use App\JobCategory;
use App\JobAttachment;
use App\JobInvitation;
use App\JobToJobCategory;
use App\UsersToLogo;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Carbon\Carbon as Carbon;
class UserController extends Controller
{
	public function my_profile(Request $request){		
	  $userId=$request->session()->get('user_id');
	  $user_type=$request->session()->get('user_type');
	  $provider_details=User::provider($userId)
						->with('get_providers_details')
						->first();
						
	  if(count($provider_details)){		 
		 $data=$this->getProviderDetails($userId);
		 return view('my_profile',$data);  
	  }else{
			return redirect('my-jobs');
		}
	}
	public function prof_description_first_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){			
			$user_details = User::find($userId);
			$user_details->prof_description =$request->user_prof_description;
			$user_details->prof_title=$request->prof_title;
			$user_details->save();
			session()->flash('success','Successfully updated your profile details.'); 
			return redirect('my-profile');
		}
	}
	public function prof_description_secend_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){
			//dd($request->all());			
			$user_details = User::find($userId);
			$user_details->primary_trade =$request->primary_trade;
			$user_details->address=$request->location;
			$user_details->lattitude=$request->lattitude;
			$user_details->longitude=$request->longitude;
			$user_details->team=$request->team;
			$user_details->year_in_biz=$request->year_in_biz;
			$user_details->working_hours=$request->from_time.'-'.$request->to_time;
			$user_details->qualification=$request->qualification;
			$user_details->emergency_job=$request->emergency_job;
			$user_details->insurance=$request->insurance;
			$user_details->holiday_notification=$request->holiday_notification;
			$user_details->save();
			session()->flash('success','Successfully updated your profile details.'); 
			return redirect('my-profile');
		}
		
	}
	public function prof_description_portpolio_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){			
		$this->validate($request, [
            'before_image' => 'required|image|mimes:jpeg,png,jpg',
            'after_image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
			$before_image = 'before_'.time().'.'.$request->before_image->getClientOriginalExtension();
			//$destinationPath = public_path('portpolio_thumbnail');
			//$thumb_img = Image::make($request->before_image->getRealPath())->resize(210, 178);
			//$request->before_image->move($destinationPath.'/'.$before_image,80);

			$destinationPath = public_path('/portpolio_normal');
			$request->before_image->move($destinationPath, $before_image);
			
			$after_image = 'after_'.time().'.'.$request->after_image->getClientOriginalExtension();
			//$destinationPath = public_path('portpolio_thumbnail');
			//$thumb_img = Image::make($request->after_image->getRealPath())->resize(210, 178);
			//$request->after_image->move($destinationPath.'/'.$after_image,80);

			$destinationPath = public_path('/portpolio_normal');
			$request->after_image->move($destinationPath, $after_image);
	
			$portpolio_details = new UsersToPortFolio;			
			$portpolio_details->before_image =$before_image;
			$portpolio_details->after_image=$after_image;
			$portpolio_details->before_image_caption=$request->before_image_caption;
			$portpolio_details->after_image_caption=$request->after_image_caption;
            $portpolio_details->user_id=$userId;			
			$portpolio_details->save();
            session()->flash('success','Your portfolio added successfully.'); 			
			return redirect('my-profile');
		}
		
	}
	public function prof_description_logo_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){
		 $this->validate($request, [           
            'logo_image' => 'required|image|mimes:jpeg,png,jpg',
			]);
			$logo_image =time().'.'.$request->logo_image->getClientOriginalExtension();

			$destinationPath = public_path('logo_image');
			//$thumb_img = Image::make($request->logo_image->getRealPath())->resize(150, 95);
			//$thumb_img->save($destinationPath.'/'.$logo_image,80);
			
			//$destinationPath = public_path('portpolio_thumbnail');
			//$thumb_img = Image::make($request->after_image->getRealPath())->resize(210, 178);
			//$request->after_image->move($destinationPath.'/'.$after_image,80);
			//$destinationPath = public_path('/portpolio_normal');
			$request->logo_image->move($destinationPath, $logo_image);
			$user_details = new UsersToLogo;			
			$user_details->logo_image =$logo_image;			
			$user_details->user_id=$userId;
			$user_details->save();
			session()->flash('success','Your logo added successfully.'); 
			return redirect('my-profile');
		}
	}
	public function prof_pic_upload(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){		 	
		 $this->validate($request, [           
            'prof_image' => 'required|image|mimes:jpeg,png,jpg',
			]);
			$prof_image =time().'.'.$request->prof_image->getClientOriginalExtension();
			$destinationPath = public_path('prof_image');
			//$thumb_img = Image::make($request->prof_image->getRealPath())->resize(149, 149);
			//$thumb_img->save($destinationPath.'/'.$prof_image,80);
			$request->prof_image->move($destinationPath, $prof_image );
			$user_details = User::find($userId);
			$user_details->prof_image =$prof_image;
			$user_details->save();
			session()->flash('success','Profile picture change successfully.'); 
			return redirect('my-profile');
		}
	}
	public function prof_description_third_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){					
			$user_details = User::find($userId);
			$user_details->qualification =$request->qualification;			
			$user_details->save();
			session()->flash('success','Successfully updated your qualification.'); 
			return redirect('my-profile');
		}
	}
	public function get_details(Request $request,Faker $faker){
		 //$userId=$request->session()->get('user_id');
				//echo new Carbon('first day of this week'); 
				//echo new Carbon('last day of previous week');
				//echo new Carbon('first day of this week');
				//echo new Carbon('last day of this week');
				$date = new \DateTime();
				//$date->modify('last week');
				//echo $date->format('Y-m-d');
				//$date->modify('+6 days');
				$date->modify('this week');
				//echo $date->format('Y-m-d');
				$date->modify('+6 days');
                 //echo $date->format('Y-m-d');
				$date->modify('last month');
				//echo $date->format('Y-m-d');
				$month_ini = new \DateTime("first day of last month");
				$month_end = new \DateTime("last day of last month");

                echo $month_ini->format('Y-m-d'); // 2012-02-01
                echo $month_end->format('Y-m-d'); // 2012-02-29
	       }
	public function view_tradesman_profile($profile_slag){			
		$tradesman_pro_details=User::tradesManProfile($profile_slag)->first();		
		if(count($tradesman_pro_details)){
			$data=$this->getProviderDetails($tradesman_pro_details->user_id);
			return view('tradesman_profile',$data);			
		}else{
			//abort(404);
		}
		
	}
	
	public function getProviderDetails($userId){		
	  $provider_details=User::provider($userId)
						->with('get_providers_details')
						->first();
	  $provider_portpolio=UsersToPortFolio::where('user_id',$userId)->get();	  
	  $provider_all_category=JobCategory::active()->get();
	  $provider_logo=UsersToLogo::where('user_id',$userId)->get();
	  if(!@$provider_details->prof_image)$provider_details->prof_image='blank-profile-picture.png';
	  $data['prof_image']=asset('public/prof_image/'.$provider_details->prof_image);
	  $data['prof_title']=$provider_details->prof_title;
	  $data['prof_description']=$provider_details->prof_description;	
	  
	  $data['provider_primary_trade']=$provider_details->get_providers_details->category_name;
	  $data['provider_primary_id']=$provider_details->get_providers_details->category_id;
	  $data['year_in_biz']=$provider_details->year_in_biz;
	  $data['qualification']=$provider_details->qualification;	  
	 
	  $data['location']=$provider_details->address;	 
      $data['insurance']=($provider_details->insurance==1)?'Yes':'No';	
      $data['emergency_job']=($provider_details->emergency_job==1)?'Yes':'No';
	  
	  $data['team']=$provider_details->team;
	  if(@$provider_details->working_hours){
		  $working_hours=explode('-',$provider_details->working_hours);
		   $data['hours_from']=$working_hours[0];
		   $data['hours_to']=$working_hours[1];
	  }else{
		   $data['hours_from']='';
		   $data['hours_to']='';
	  }
	  
	  $data['working_hours']=$provider_details->working_hours;
	  $data['member_since']=date('jS M Y',strtotime($provider_details->registration_date));
	  
	  $data['lattitude']=$provider_details->lattitude;
	  $data['longitude']=$provider_details->longitude;
	  $data['holiday_notification']=($provider_details->holiday_notification==1)?'checked':null;
	  $data['provider_category']=$provider_all_category;
  	
	  $data['port_polio']=$provider_portpolio;
	  $data['provider_logo']=$provider_logo;
	  return $data;
	}
	public function invited_builder_list(Request $request){
		$get_job_category = DB::table(TBL_JOB_TO_CATEGORY)->where('job_id',$request->job_id)->first();
		if(count($get_job_category)>0)
		{
			$get_user = DB::table(TBL_USER)->select('user_id','user_name','email','user_slug','prof_description','prof_image','tot_review','avg_review',TBL_JOB_CATEGORY.'.category_name')
			->leftJoin(TBL_JOB_CATEGORY,TBL_USER.'.primary_trade','=',TBL_JOB_CATEGORY.'.category_id')
			->where('primary_trade',$get_job_category->category_id)->get();
			//echo "<pre>";print_r($get_user);die;
			$returnHTML = view('ajax_page.invited_builder')->with('get_user', $get_user)->with('job_id',$request->job_id)->render();
			$responce = array('user_html'=>$returnHTML);
		}
		echo json_encode($responce);
	}
	public function invited_builder(Request $request){
		$fetch_job = DB::table(TBL_JOB_POST)->where('job_id',$request->job_id)->first();
		if(count($fetch_job)>0 && $fetch_job->user_id == session()->get('user_id'))
		{
			$get_job_category = DB::table(TBL_JOB_TO_CATEGORY)->where('job_id',$request->job_id)->first();
			$builder = DB::table(TBL_USER)->select('user_id','primary_trade')->where('user_id',$request->builder_id)->first();
			if($get_job_category->category_id == $builder->primary_trade)
			{
				$insert = array();
				$insert['job_id'] = $request->job_id;
				$insert['from_user_id'] = session()->get('user_id');
				$insert['to_user_id'] = $request->builder_id;
				$insert['invitation_date'] = date('Y-m-d H:i:s');
				DB::table(TBL_JOB_INVITATION)->insert($insert);
				$responce = array('invited'=>1);
			}
			else{
				$responce = array('invited'=>2);
			}
			echo json_encode($responce);
		}
	}
	public function my_invited(Request $request){   
		 $userId=$request->session()->get('user_id');
	     $user_type=$request->session()->get('user_type');
		 $provider_job_invitation=JobInvitation::invitedProvider($userId)
					->with('providerJobDetails.jobType','providerJobDetails.users')					
					->with('categoryDetails.category')
					->get();					
		 $data['provider_job_invitation']=$provider_job_invitation;
		 return view('builder_invited',$data);
	}
	public function provider_quote_submit(Request $request){		
		//return view('mail.proposal');
		if(@$request->all()){			
		     $quote_attachment =time().'.'.$request->quote_attachment->getClientOriginalExtension();
			 $destinationPath = storage_path('invitation_attachment');
			//$thumb_img = Image::make($request->prof_image->getRealPath())->resize(149, 149);
			//$thumb_img->save($destinationPath.'/'.$prof_image,80);
			$request->quote_attachment->move($destinationPath, $quote_attachment);
			$invitation_id=$request->invitation_id;
			$invitation_details = JobInvitation::find($invitation_id);
			$invitation_details->started_date =date('Y-m-d H:i:s',strtotime($request->start_date));
			$invitation_details->description =$request->quote_description;
			$invitation_details->price =$request->price;
			$invitation_details->attachment =$quote_attachment;
			$invitation_details->invitation_date =date('Y-m-d H:i:s');			
			$invitation_details->invitation_status =1;	//reply from builders		
			$invitation_details->save();
			session()->flash('success','Successfully submited your quote.'); 
			return redirect('my-invited');
		}
	}
	public function builder_proposal_list(Request $request){
		$get_job = DB::table(TBL_JOB_POST)->where('job_id',$request->job_id)->first();
		if(count($get_job)>0 && $get_job->user_id == session()->get('user_id'))
		{
			$get_user = DB::table(TBL_JOB_INVITATION)->select(TBL_JOB_INVITATION.'.*',TBL_USER.'.user_id',TBL_USER.'.user_name',TBL_USER.'.user_slug',TBL_USER.'.prof_image',TBL_USER.'.tot_review',TBL_USER.'.avg_review')
			->leftJoin(TBL_USER,TBL_JOB_INVITATION.'.to_user_id','=',TBL_USER.'.user_id')
			->where('invitation_status','!=',0)
			->where('job_id',$request->job_id)
			->get();
			//echo "<pre>";print_r($get_user);die;
			$returnHTML = view('ajax_page.proposal_builder')->with('get_user', $get_user)->with('job_id',$request->job_id)->render();
			$responce = array('proposal_html'=>$returnHTML);
		}
		echo json_encode($responce);
	}
	public function hire_builder(Request $request){
		$fetch = DB::table(TBL_JOB_INVITATION)->where('job_invitation_id',$request->job_invitation_id)->first();
		if(count($fetch)>0 && $fetch->from_user_id == session()->get('user_id'))
		{
			$update = array(
			'invitation_status'=>2,
			'awarded_job_date'=>date('Y-m-d')
			);
			DB::table(TBL_JOB_INVITATION)->where('job_invitation_id',$request->job_invitation_id)->update($update);
			$responce = array('hired'=>1);
			echo json_encode($responce);
		}
	}
	public function awarded_provider_job(Request $request){	
		$to_date='';
		$form_date='';
		$date = new \DateTime();
		if ($request->isMethod('post')) {
				$filter_type=$request->job_filter;					
				switch($filter_type){
					case 'this week' :
					$date->modify($filter_type);
					$form_date =$date->format('Y-m-d');
					$date->modify('+6 days');				
					$to_date=$date->format('Y-m-d');
					break;
					case 'last week' :
					$date->modify($filter_type);
					$form_date =$date->format('Y-m-d');
					$date->modify('+6 days');				
					$to_date=$date->format('Y-m-d');
					break;
					case 'last month' :
					$month_ini = new \DateTime("first day of last month");
					$month_end = new \DateTime("last day of last month");
					$form_date= $month_ini->format('Y-m-d'); 
					$to_date= $month_end->format('Y-m-d'); 
					break;
			  }			
		}
		$userId=$request->session()->get('user_id');
		$provider_job_invitation=JobInvitation::awaredProvider($userId)
								->filterBydate($form_date,$to_date)
								->with('providerJobDetails.jobType','providerJobDetails.users')					
								->with('categoryDetails.category')
								->get();
						
		 $data['provider_job_invitation']=$provider_job_invitation;	
		return view('builder_awarded_jobs',$data);
	}
	public function provider_mark_complete_job(Request $request){
		if ($request->isMethod('post')){
			$invitation_id=$request->invitation_id;
			$invitation_details = JobInvitation::find($invitation_id);
			$invitation_details->invitation_status =3;	//reply from builders		
			$invitation_details->save();
			$job_id=$invitation_details->job_id;
			$job_details= Jobs::find($job_id);
			$job_details->job_status=3;
			$job_details->save();
			//change the job status			
			session()->flash('success','Successfully submited your status.'); 
			return redirect('my-awarded-job');
		}
	}
	
	
}
