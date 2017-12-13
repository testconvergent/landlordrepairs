<?php
namespace App\Http\Controllers;
use DB;
use App;
use App\User;
use App\Jobs;
use Image;
use App\JobCategory;
use App\JobAttachment;
use App\UserToPortPolio;
use App\JobToJobCategory;
use App\UsersToLogo;
use Illuminate\Http\Request;
class UserController extends Controller
{
	public function my_profile(Request $request){		
	  $userId=$request->session()->get('user_id');
	  $user_type=$request->session()->get('user_type');
	  $provider_details=User::with('get_providers_details')
					->where('user_id',$userId)
					->first();
	
		
	  $jobs_category=JobToJobCategory::with('job.users','category')->get();
	 // dd($jobs_category);
	  $provider_portpolio=UserToPortPolio::where('user_id',$userId)->get();
	  $provider_category=JobCategory::where('category_status',1)->get();
	  
	  $provider_logo=UsersToLogo::where('user_id',$userId)->get();
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
	  $working_hours=explode('-',$provider_details->working_hours);

	  $data['hours_from']=$working_hours[0];
	  $data['hours_to']=$working_hours[1];
	  $data['working_hours']=$provider_details->working_hours;
	  $data['member_since']=date('jS M Y',strtotime($provider_details->registration_date));
	  
	  $data['lattitude']=$provider_details->lattitude;
	  $data['longitude']=$provider_details->longitude;
	  $data['holiday_notification']=($provider_details->holiday_notification==1)?'checked':null;
	  $data['provider_category']=$provider_category;
  	
	  $data['port_polio']=$provider_portpolio;
	  $data['provider_logo']=$provider_logo;	
	  return view('my_profile',$data);
	}
	public function prof_description_first_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){			
			$user_details = User::find($userId);
			$user_details->prof_description =$request->user_prof_description;
			$user_details->prof_title=$request->prof_title;
			$user_details->save();
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

			$destinationPath = public_path('portpolio_thumbnail');
			$thumb_img = Image::make($request->before_image->getRealPath())->resize(210, 178);
			$thumb_img->save($destinationPath.'/'.$before_image,80);

			$destinationPath = public_path('/portpolio_normal');
			$request->before_image->move($destinationPath, $before_image);
			$after_image = 'after_'.time().'.'.$request->after_image->getClientOriginalExtension();

			$destinationPath = public_path('portpolio_thumbnail');
			$thumb_img = Image::make($request->after_image->getRealPath())->resize(210, 178);
			$thumb_img->save($destinationPath.'/'.$after_image,80);

			$destinationPath = public_path('/portpolio_normal');
			$request->after_image->move($destinationPath, $after_image);
	
			$portpolio_details = new UserToPortPolio;			
			$portpolio_details->before_image =$before_image;
			$portpolio_details->after_image=$after_image;
			$portpolio_details->before_image_caption=$request->before_image_caption;
			$portpolio_details->after_image_caption=$request->after_image_caption;
            $portpolio_details->user_id=$userId;			
			$portpolio_details->save();			
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
			$thumb_img = Image::make($request->logo_image->getRealPath())->resize(150, 95);
			$thumb_img->save($destinationPath.'/'.$logo_image,80);
			
			$user_details = new UsersToLogo;			
			$user_details->logo_image =$logo_image;			
			$user_details->user_id=$userId;
			$user_details->save();
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
			$thumb_img = Image::make($request->prof_image->getRealPath())->resize(149, 149);
			$thumb_img->save($destinationPath.'/'.$prof_image,80);
			$user_details = User::find($userId);
			$user_details->prof_image =$prof_image;
			$user_details->save();
			return redirect('my-profile');
		}
	}
	public function prof_description_third_block(Request $request){
		$userId=$request->session()->get('user_id');
		if(@$request->all()){					
			$user_details = User::find($userId);
			$user_details->qualification =$request->qualification;			
			$user_details->save();
			return redirect('my-profile');
		}
	}
}
