<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
class ProviderController extends Controller
{
   public function request_feedback(Request $request){
	   if($request->isMethod('post')){
		    $invitation_master_id=$request->invitation_master_id;
		    $invitation_details = JobInvitation::find($invitation_master_id);
			 /*********************jod details****************/
			$job_details=Jobs::find($invitation_details->job_id);
			$job_title=$job_details->looking_for;
			$customer_email=User::find($invitation_details->from_user_id)->email;			
			$request_feedback=new \StdClass();			
			$request_feedback->customer_name=User::find($invitation_details->from_user_id)->user_name;			
			$request_feedback->feedback_description=$request->request_feedback;			
			$request_feedback->provider_email=User::find($invitation_details->to_user_id)->email;
			$request_feedback->job_title=$job_title;
			$request_feedback->subject='Request feedback for'.$job_title;			
			Mail::to($customer_email)->send(new App\Mail\requestFeedback($request_feedback));
			return redirect('my-awarded-job');
	   }
   }
   public function provider_mark_complete_job(Request $request){
		if ($request->isMethod('post')){
			$invitation_id=$request->invitation_id;
			$invitation_details = JobInvitation::find($invitation_id);
			$invitation_details->invitation_status =3;	//3 for job marked as completed	
			$invitation_details->save();
			$job_id=$invitation_details->job_id;
			$job_details= Jobs::find($job_id);
			$job_details->job_status=4;   // 4 for completed job
			$invitation_details->job_complete_date =date('Y-m-d H:i:s');	
			$job_details->save();					
			session()->flash('success','Successfully submited your status.'); 
			return redirect('my-awarded-job');
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
			//$invitation_details->job_complete_date =date('Y-m-d H:i:s');			
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
}
