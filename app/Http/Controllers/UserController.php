<?php
namespace App\Http\Controllers;
use DB;
use Mail;
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
use App\UsersToReview;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Carbon\Carbon as Carbon;
class UserController extends Controller
{
	
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
			$data['review']=$this->getreview($tradesman_pro_details->user_id);
			return view('tradesman_profile',$data);			
		}else{
			//abort(404);
		}
	}	
	public function invited_builder_list(Request $request){
		$get_job_category = DB::table(TBL_JOB_TO_CATEGORY)->where('job_id',$request->job_id)->first();
		$get_job = DB::table(TBL_JOB_POST)->where('job_id',$request->job_id)->first();
		//echo "<pre>";print_r($get_job);
		if(count($get_job_category)>0 && count($get_job)>0 && $get_job->user_id == session()->get('user_id'))
		{
			$get_user = DB::table(TBL_USER)
			->select('user_id','user_name','email','user_slug','prof_description','prof_image','tot_review','avg_review','lattitude','longitude',TBL_JOB_CATEGORY.'.category_name')
			->addSelect(DB::raw("(3956 * 2 * ASIN(SQRT(POWER(SIN((CAST($get_job->lattitude AS decimal(10,6)) - lattitude) * pi()/180 / 2), 2) + COS(CAST($get_job->lattitude AS decimal(10,6)) * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN((CAST($get_job->longitude AS decimal(10,6)) - longitude) * pi()/180 / 2), 2)))) as distance"))
			->leftJoin(TBL_JOB_CATEGORY,TBL_USER.'.primary_trade','=',TBL_JOB_CATEGORY.'.category_id')
			->where('primary_trade',$get_job_category->category_id)
			->having('distance','<=',32.1869) //20 miles =32.1869km
			->orderBy('distance','asc')
			->get();			
			//echo "<pre>";print_r($get_user);die;
			
			$returnHTML = view('ajax_page.invited_builder')->with('get_user', $get_user)->with('job_id',$request->job_id)->with('job',$get_job)->render();
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
	
	public function provider_quote_submit(Request $request){		
		//return view('mail.proposal');
		if(@$request->all()){			
		    $quote_attachment =time().'.'.$request->quote_attachment->getClientOriginalExtension();
			$destinationPath = storage_path('invitation_attachment');			
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
			$customer_id=$invitation_details->from_user_id;
			$tradesman_id=$invitation_details->to_user_id;
			$job_id=$invitation_details->job_id;
            /*send mail for proposal to customer from provider */
						
			/*calculate average bid and total bid */
			 $job_details=Jobs::find($job_id);
			 $proposal_for=$job_details->looking_for;
			 $job_details->avg_bid=JobInvitation::all()->where('job_id',$job_id)->where('invitation_status',1)->avg('price');
			
			 $job_details->no_of_bids=$job_details->no_of_bids+1;
			 $job_details->save();
			 $job_category_details=JobToJobCategory::with('category')
											->whereHas('category',function($query)use($job_id){
											return $query->where('job_id',$job_id);
												})
											->first();
			$job_type_details=Jobs::find($job_id)->with('jobType')->first();			
			$customer_email=User::find($customer_id)->email;
			$tradesman_email=User::find($tradesman_id)->email;
			/*for mail average bid and total bid */
			$proposal_details=new \StdClass();
			$proposal_details->proposed_price=$request->price;
			$proposal_details->customer_name=User::find($customer_id)->user_name;
			$proposal_details->proposed_date=date('D j-M Y',strtotime($request->start_date));
			$proposal_details->proposal_description=$request->quote_description;
			$proposal_details->category=$job_category_details->category->category_name;
			$proposal_details->job_type=$job_type_details->jobType->job_type_name;			
			$proposal_details->tradesman_email=$tradesman_email;			
			$proposal_details->tradesman_name=User::find($tradesman_id)->user_name;
			$proposal_details->looking_for=$proposal_for;
			$proposal_details->subject='Proposal for '.$proposal_for;			
			$data['proposal']=$proposal_details;			
			Mail::to($customer_email)->send(new App\Mail\proposalMail($proposal_details));			
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
			$update_lost = array(
			'invitation_status'=>4
			);
			DB::table(TBL_JOB_INVITATION)
			->where('job_invitation_id','!=',$request->job_invitation_id)
			->where('job_id',$fetch->job_id)
			->where('from_user_id',session()->get('user_id'))
			->update($update_lost);
			$update_job = array('job_status'=>3);
			DB::table(TBL_JOB_POST)->where('job_id',$fetch->job_id)->update($update_job);
			$get_user = DB::table(TBL_USER)->select('job_win','user_name','email')->where('user_id',$fetch->to_user_id)->first();
			$update_builder = array(
			'job_win'=>$get_user->job_win+1
			);
			DB::table(TBL_USER)->where('user_id',$fetch->to_user_id)->update($update_builder);
			/*Job Hired Mail*/
				$get_job = DB::table(TBL_JOB_POST)->select(TBL_JOB_POST.'.*',TBL_JOB_CATEGORY.'.category_name',TBL_JOB_TYPE.'.job_type_name')
				->leftJoin(TBL_JOB_TO_CATEGORY,TBL_JOB_POST.'.job_id','=',TBL_JOB_TO_CATEGORY.'.job_id')
				->leftJoin(TBL_JOB_CATEGORY,TBL_JOB_TO_CATEGORY.'.category_id','=',TBL_JOB_CATEGORY.'.category_id')
				->leftJoin(TBL_JOB_TYPE,TBL_JOB_POST.'.job_type_id','=',TBL_JOB_TYPE.'.job_type_id')
				->where(TBL_JOB_POST.'.job_id',$fetch->job_id)->first();
				$customer = fetch_user(session()->get('user_id'));
				$hire_details=new \StdClass();
				$email = $get_user->email;
				$hire_details->subject='Hired for '.$get_job->looking_for;
				$hire_details->looking_for=$get_job->looking_for;
				$hire_details->provider_name=$get_user->user_name;
				$hire_details->customer_name=$customer->user_name;
				$hire_details->category_name=$get_job->category_name;
				$hire_details->job_type=$get_job->job_type_name;
				$hire_details->job_price=$get_job->budget;
				$hire_details->hire_price=$fetch->price;
				//Mail::to($email)->send(new App\Mail\hiredMail($hire_details));	
			/*Job Hired Mail*/
			$responce = array('hired'=>1);
			echo json_encode($responce);
		}
	}
	public function report_builder(Request $request)
	{
		if(@$request->all())
		{
			$insert = array();
			$insert['report_title'] = $request->report_title;
			$insert['report_description'] = $request->report_description;
			$insert['job_id'] = $request->job_id;
			$insert['builder_id'] = $request->builder_id;
		}
	}
	/* SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( 78.751956 - lattitude) * pi()/180 / 2), 2) +COS( 78.751956 * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN(( 43.690306 - longitude) * pi()/180 / 2), 2) ))) as distance from users having distance <= 10 order by distance */
}
