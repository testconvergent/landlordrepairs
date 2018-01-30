<?php
namespace App\Http\Controllers;
use DB;
use Mail;
use URL;
use App\Mail\invitationMail;
use App\Mail\proposalMail;
use App\Mail\hiredMail;
use App\Mail\recommendUsMail;
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
use Illuminate\Support\Facades\Gate;
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

               // echo $month_ini->format('Y-m-d'); // 2012-02-01
               // echo $month_end->format('Y-m-d'); // 2012-02-29
			   return view('test.home');
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
			->where('holiday_notification',0)
			->having('distance','<=',32.1869) //20 miles =32.1869km
			->orderBy('distance','asc')
			->get();			
			//echo "<pre>";print_r($get_user);die;
			$data['get_user']=$get_user;
			$data['job_id']=$request->job_id;
			$data['job']=$get_job;
			return  array('user_html'=>view('ajax_page.invited_builder',$data)->render());
		}		
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
				
				// A mail has been sent to builder for job invitation				
				$job_details=Jobs::find($request->job_id);				
				$invitation_details=new \StdClass();
				$invitation_details->budget=$job_details->budget;				
				$invitation_details->looking_for=$job_details->looking_for;				
				$invitation_details->deadline=date('D j-M Y',strtotime($request->start_date));
				$invitation_details->city=$job_details->city;
				$invitation_details->job_details=$job_details->job_details;
				$invitation_details->tradesman_email=User::find($request->builder_id)->email;			
				$invitation_details->tradesman_name=User::find($request->builder_id)->user_name;
				$invitation_details->customer_name=User::find(session()->get('user_id'))->user_name;	
				$invitation_details->looking_for=$job_details->looking_for;
				$invitation_details->subject='Invitation for '.$job_details->looking_for;			
				$data['proposal']=$invitation_details;							
				Mail::to($invitation_details->tradesman_email)->send(new invitationMail($invitation_details));
				$responce = array('invited'=>1,'tradesman_mail'=>$invitation_details->tradesman_email);				
			}
			else{
				$responce = array('invited'=>2,'tradesman_mail'=>$invitation_details->tradesman_email);
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
			Mail::to($customer_email)->send(new proposalMail($proposal_details));			
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
		{   $update = array(
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
				Mail::to($email)->send(new hiredMail($hire_details));	
			/*Job Hired Mail*/
			$responce = array('hired'=>1);
			echo json_encode($responce);
		}
	}
	public function jobs_given(){
		if(session()->get('user_type') == 3){
			$get_job_given = DB::table(TBL_JOB_INVITATION)->select(TBL_JOB_INVITATION.'.*',TBL_JOB_POST.'.job_details',TBL_JOB_POST.'.looking_for',TBL_JOB_CATEGORY.'.category_name',TBL_JOB_TYPE.'.job_type_name',TBL_USER.'.user_name',TBL_USER.'.prof_image',TBL_JOB_POST.'.deadline',TBL_JOB_POST.'.city')
			->leftJoin(TBL_JOB_POST,TBL_JOB_INVITATION.'.job_id','=',TBL_JOB_POST.'.job_id')
			->leftJoin(TBL_JOB_TO_CATEGORY,TBL_JOB_POST.'.job_id','=',TBL_JOB_TO_CATEGORY.'.job_id')
			->leftJoin(TBL_JOB_CATEGORY,TBL_JOB_TO_CATEGORY.'.category_id','=',TBL_JOB_CATEGORY.'.category_id')
			->leftJoin(TBL_JOB_TYPE,TBL_JOB_POST.'.job_type_id','=',TBL_JOB_TYPE.'.job_type_id')
			->leftJoin(TBL_USER,TBL_JOB_INVITATION.'.to_user_id','=',TBL_USER.'.user_id')
			->where(TBL_JOB_INVITATION.'.from_user_id',session()->get('user_id'))
			->where(function($query){
				$query->where(TBL_JOB_INVITATION.'.invitation_status',2)
				->orwhere(TBL_JOB_INVITATION.'.invitation_status',3);
			})
			->get();
			//echo"<pre>";print_r($get_job_given);die;
			$data = array('job_given'=>$get_job_given);
			return view('customer_job_given',$data);
		}
		else if(session()->get('user_type') == 2)
		{
			return redirect('my-profile');
		}
	}
	public function review_post(Request $request){
		$get = DB::table(TBL_JOB_INVITATION)->where('from_user_id',session()->get('user_id'))->where('to_user_id',$request->builder_id)->where('job_id',$request->job_id)->where('invitation_status',3)->first();
		if(count($get)>0)
		{			
			$insert_rev = array();
			$insert_rev['user_id'] = session()->get('user_id');
			$insert_rev['builder_id'] = $request->builder_id;
			$insert_rev['job_id'] = $request->job_id;
			$insert_rev['quality'] = $request->quality_rating;
			$insert_rev['on_time'] = $request->time_rating;
			$insert_rev['price'] = $request->price_rating;
			$insert_rev['hire'] = $request->hire_rating;
			$insert_rev['recomm'] = $request->recomm_rating;
			$insert_rev['comments'] = $request->rev_comment;
			$insert_rev['review_title'] = $request->rev_title;
			$insert_rev['review_date'] = date('Y-m-d');
			$insert_rev['total_review'] = ($request->quality_rating+$request->time_rating+ $request->price_rating+$request->hire_rating+$request->recomm_rating);
			$insert_rev['ave_review'] = ($insert_rev['total_review']/5);
			DB::table(TBL_REVIEW)->insert($insert_rev);
			/*User review*/
			$get_rev = DB::table(TBL_REVIEW)->where('builder_id',$request->builder_id)->avg('ave_review');
			$get_rev_total = DB::table(TBL_REVIEW)->where('builder_id',$request->builder_id)->count();
			/* echo "<pre>";print_r($get_rev_total);
			echo "<pre>";print_r($get_rev);
			die; */
			$update_buider = array(
				'tot_review'=>$get_rev_total,
				'avg_review'=>$get_rev
			);
			DB::table(TBL_USER)->where('user_id',$request->builder_id)->update($update_buider);
			/*User review*/
			$update_ivitation = array('is_review'=>1);
			DB::table(TBL_JOB_INVITATION)->where('job_invitation_id',$get->job_invitation_id)->update($update_ivitation);
			session()->flash('success','Review posted successfully');
		}
		return redirect('jobs-given');
	}
	public function report_builder(Request $request){
		if(@$request->all()){
			$insert = array();
			$insert['report_title'] = $request->report_title;
			$insert['report_description'] = nl2br($request->report_description);
			$insert['job_id'] = $request->job_id;
			$insert['report_to_user_id'] = $request->builder_id;
			$insert['report_date'] = date('Y-m-d H:i:s');
			$insert['report_from_user_id'] = session()->get('user_id');
			DB::table(TBL_REPORT_BUILDER)->insert($insert);
			session()->flash('success','Report submitted successfully');
			return redirect('jobs-given');
		}
	}	
	public function send_recommend_us_mail(Request $request){    
		$recommendation=new \stdClass();
		$user_id=session()->get('user_id');
		$user_name=User::find($user_id)->user_name;
		$recommendation->name=$user_name;
		$recommendation->recomended_name=$request->name;		
		$recommendation->user_type=$request->user_type;
		$recommendation->subject='Recommended as a '.$request->user_type;		
		$recommendation->to_email=$request->email;		
		$recommendation->phone=$request->phone;		
		$recommendation->description=$request->description;
		Mail::to($recommendation->to_email)->send(new recommendUsMail($recommendation));
		session()->flash('success_recommendation','A recommendation mail has been sent for '.$request->user_type);
		return redirect(URL::previous());
	}
}
