<?php
namespace App\Http\Controllers\admin;
use DB;
use App;
use App\User;
use App\Jobs;
use App\JobCategory;
use App\JobAttachment;
use App\UsersToPortFolio;
use App\JobToJobCategory;
use App\UsersToLogo;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use App\Http\Controllers\Controller;
class JobController extends Controller
{
	public function posted_job_list(Request $request){
		if($request->isMethod('post')){
		$category_id=$request->category_id;
		$keyword=$request->keyword;		
		$posted_job_details =JobToJobCategory::whereHas('job.users',function($query)use($keyword){
										$query->where('looking_for',  'like', '%'.$keyword.'%');
									})									
									->whereHas('category', function($query)use($category_id){
											if(@$category_id)$query->where('category_id', $category_id);
									})
								->paginate(25);
		
		$data['posted_job_details']=$posted_job_details;
		}else{		
		$posted_job_details =JobToJobCategory::with('job.users','category')->paginate(25);
		$data['posted_job_details']=$posted_job_details;
		}        		
		$data['category_details']=JobCategory::all();	
		return view('admin.posted_job_list',$data);
	}
	public function change_job_status($id){
		$job=Jobs::find($id);
		if($job->job_status==1){
			$job->job_status=2;
		$job->save();
		}else{
			$job->job_status=1;
			$job->save();
		}
		return redirect('admin-posted-job-list');
	}
	public function view_job_details($job_id){		
		$job_details =JobToJobCategory::with('job.users','category')
									    ->with('job.attachment')
									    ->get();								
		$job_details = $job_details->filter(function($jobs)use($job_id) {			
				return $jobs->job->job_id == $job_id;
			})->first();
		$data['job_details']=$job_details;
		
		return view('admin.job_details',$data);
	}
}
