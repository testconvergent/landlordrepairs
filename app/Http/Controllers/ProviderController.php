<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App;
use DB;
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
class ProviderController extends Controller{
	public function my_profile(Request $request){		
		  $userId=$request->session()->get('user_id');
		  $user_type=$request->session()->get('user_type');
		  $provider_details=User::provider($userId)->with('get_providers_details')->first();
		  if(count($provider_details)){		 
			 $data=$this->getProviderDetails($userId);
			 $data['review']=$this->getreview($userId);
			 return view('my_profile',$data);  
		  }else{
				return redirect('my-jobs');
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
	 $data['user_name']=$provider_details->user_name;	 
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
	public function getreview($buider_id){
		$review = UsersToReview::where('builder_id',$buider_id)->with('review')->get();
		//dd($review->review->user_name);
		return $review;
	}
    public function request_feedback(Request $request){
	   if($request->isMethod('post')){
		    $invitation_master_id=$request->invitation_master_id;
		    $invitation_details = JobInvitation::find($invitation_master_id);
			 /*********************request feedback mail description****************/
			$job_details=Jobs::find($invitation_details->job_id);
			$job_title=$job_details->looking_for;
			$customer_email=User::find($invitation_details->from_user_id)->email;			
			$request_feedback=new \StdClass();			
			$request_feedback->customer_name=User::find($invitation_details->from_user_id)->user_name;			
			$request_feedback->feedback_description=$request->request_feedback;			
			$request_feedback->provider_email=User::find($invitation_details->to_user_id)->email;
			$request_feedback->job_title=$job_title;
			$request_feedback->subject='Request feedback for'.$job_title;			
			//Mail::to($customer_email)->send(new App\Mail\requestFeedback($request_feedback));
			 /*********************request feedback mail description end****************/
			return redirect('my-awarded-job');
	   }
   }
    public function provider_mark_complete_job(Request $request){
		if ($request->isMethod('post')){
			$invitation_id=$request->invitation_id;
			/**************update the job-invitation table for mark as completed from provider end**************/
			$invitation_details = JobInvitation::find($invitation_id);
			$invitation_details->invitation_status =3;	//3 for job marked as completed	
			$invitation_details->job_complete_date =date('Y-m-d H:i:s');
			$invitation_details->save();		
			/**************update the job table for mark as completed from provider end**************/
			$job_id=$invitation_details->job_id;
			$job_details= Jobs::find($job_id);
			$job_details->job_status=4;   // 4 for completed job
			$job_details->save();		

			 /*********************request as complete mail description****************/
			$job_details=Jobs::find($invitation_details->job_id);
			$job_title=$job_details->looking_for;
			$customer_email=User::find($invitation_details->from_user_id)->email;			
			$request_complete=new \StdClass();			
			$request_complete->customer_name=User::find($invitation_details->from_user_id)->user_name;			
			$request_complete->feedback_description=$request->request_feedback;			
			$request_complete->provider_email=User::find($invitation_details->to_user_id)->email;
			$request_complete->tradesman_name =User::find($invitation_details->to_user_id)->user_name;
			$request_complete->job_title=$job_title;
			$request_complete->subject='Complete the job of - '.$job_title;
			//Mail::to($customer_email)->send(new App\Mail\providerMarkCompletedMail($request_complete));
			/*********************request as complete mail description end****************/
						
			session()->flash('success','Successfully submited your status.'); 
			return redirect('my-awarded-job');
		}
	}
	public function provider_quote_submit(Request $request){
		if(@$request->all()){
			if($request->hasFile('quote_attachment')){
			 $quote_attachment =time().'.'.$request->quote_attachment->getClientOriginalExtension();
			 $destinationPath = storage_path('invitation_attachment');			
			 $request->quote_attachment->move($destinationPath, $quote_attachment);	
			}else{
				 $quote_attachment=null;
			}	
			$invitation_id=$request->invitation_id;
			$invitation_details = JobInvitation::find($invitation_id);
			$invitation_details->started_date =date('Y-m-d H:i:s',strtotime($request->start_date));
			$invitation_details->description =$request->quote_description;
			$invitation_details->price =$request->price;
			$invitation_details->attachment =$quote_attachment;						
			$invitation_details->attachment =$quote_attachment;						
			$invitation_details->invitation_status =1;	//reply from builders		
			$invitation_details->save();
			$customer_id=$invitation_details->from_user_id;
			$tradesman_id=$invitation_details->to_user_id;
			$job_id=$invitation_details->job_id;
/************calculate average bid and total bid ***********************/
			 $job_details=Jobs::find($job_id);
			 $proposal_for=$job_details->looking_for;
			 $job_details->avg_bid=JobInvitation::all()->where('job_id',$job_id)->where('invitation_status',1)->avg('price');
			 $job_details->no_of_bids=$job_details->no_of_bids+1;
			 $job_details->save();
			 
	 /*********************submit quote mail description*******************/ 
			 $job_category_details=JobToJobCategory::with('category')
											->whereHas('category',function($query)use($job_id){
											return $query->where('job_id',$job_id);
												})
											->first();
			$job_type_details=Jobs::find($job_id)->with('jobType')->first();			
			$customer_email=User::find($customer_id)->email;
			$tradesman_email=User::find($tradesman_id)->email;
			
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
			//Mail::to($customer_email)->send(new App\Mail\proposalMail($proposal_details));	
	 /************************submit quote mail description********************************/ 	
			session()->flash('success','Successfully submited your quote.'); 
			return redirect('my-invited');
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
			$user_details->holiday_notification=($request->holiday_notification=='')?0:1;
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
			if(@$user_details->prof_image)unlink($destinationPath.'/'.$user_details->prof_image);
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
								->with(['providerJobDetails'=>function($providerJobDetail){
								 $providerJobDetail->with('users')->with('jobReview')->with('attachment')->with('jobToCategory.category');
								}])
								->get();
						
		$data['provider_job_invitation']=$provider_job_invitation;	
		return view('builder_awarded_jobs',$data);
	}
	public function my_invited(Request $request){
		// DB::enableQueryLog();	
		 $userId=$request->session()->get('user_id');
	     $user_type=$request->session()->get('user_type');
		 $provider_job_invitation=JobInvitation::with(['providerJobDetails'=>function($providerJobDetail){
						 $providerJobDetail->with('users')->with('jobReview')->with('attachment')->with('jobToCategory.category');
						}])->invitedProvider($userId)
					->get();								
     /*--------------Read new job invitation------------------------*/
		 $readNewInvitation=JobInvitation::newJobInvitation($userId)
							->update(['invitation_read' => 1]);
     /*------------Read new job invitation------------------------*/	 
		 $data['provider_job_invitation']=$provider_job_invitation;
		 return view('builder_invited',$data);
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
}
