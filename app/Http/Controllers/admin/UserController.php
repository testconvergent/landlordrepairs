<?php
namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
	public function customers_list(Request $request)
	{
		$user = DB::table(TBL_USER);
		$post_data = $request->all();
		if(@$post_data)
		{
			if(@$request->status)
			{
			  $user = $user->where('user_status',$request->status);
			}
			if(@$request->keyword)
			{
				$user = $user->where(function($where) use ($request){
					    $where->where('user_name','like','%'.$request->keyword.'%')
						->orwhere('email','like','%'.$request->keyword.'%');
				});
			}
			$users = $user->where('user_type',3)->where('user_status','!=',3)->orderBy('user_id', 'DESC')->paginate(25);
	    }
		else
		{
		   $users = $user->where('user_type',3)->where('user_status','!=',3)->orderBy('user_id', 'DESC')->paginate(25);
	    }
		$data = ['user'=>$users,'post_data'=>$request->all()];
		return view('admin.customers_list',$data);
	}
	public function tradesmen_list(Request $request){
		$user = DB::table(TBL_USER);
		$post_data = $request->all();
		if(@$post_data)
		{
			if(@$request->status)
			{
				if($request->status == 5)
				{
					$status = 0;
				}
				else
				{
					$status = $request->status;
				}
			$user = $user->where('user_status',$status);
			}
			if(@$request->keyword){
				$user = $user->where(function($where) use ($request){
					    $where->where('user_name','like','%'.$request->keyword.'%')
						->orwhere('email','like','%'.$request->keyword.'%');
				});
			}
			$users = $user->where('user_type',2) ->where('user_status','!=',3) ->orderBy('user_id', 'DESC')->paginate(25);
		}
		else
		{
		   $users = $user->where('user_type',2)->where('user_status','!=',3)->orderBy('user_id', 'DESC')->paginate(25);
		}
		$data = ['user'=>$users,'post_data'=>$request->all()];	  
		return view('admin.tradesmen_list',$data);
	}
	public function customer_status($id){
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		if($user->user_status == 1)
		{
			$update = array('user_status'=>2);
		}
		else
		{
			$update = array('user_status'=>1);
		}
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','User status change successfully');
		return redirect('admin-customers-list');
	}
	public function tradesmen_status($id){
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		if($user->user_status == 1)
		{
			$update = array('user_status'=>2);
		}
		else
		{
			$update = array('user_status'=>1);
		}
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','User status change successfully');
		return redirect('admin-tradesmen-list');
	}
	public function customer_details($id)
	{
		$users = DB::table(TBL_USER)->where('user_id',$id)->where('user_type',3)->first();
		if(count($users)>0)
		{
			$data = ['user'=>$users];
			return view('admin.customer_details',$data);
		}
		else
		{
			return redirect('admin-customers-list');
		}
	}
	public function tradesmen_details($id)
	{
		$users = DB::table(TBL_USER)->select(TBL_USER.'.*',TBL_JOB_CATEGORY.'.category_name')
		->leftJoin(TBL_JOB_CATEGORY,TBL_USER.'.primary_trade','=',TBL_JOB_CATEGORY.'.category_id')
		->where('user_id',$id)->where('user_type',2)->first();
		//echo "<pre>";print_r($users);die;
		if(count($users)>0)
		{
			$data = ['user'=>$users];
			return view('admin.tradesmen_details',$data);
		}
		else
		{
			return redirect('admin-customers-list');
		}
	}
	public function seller_status($id){
		$user = DB::table(TBL_USER)
					->where('user_id',$id)
					->first();
		if($user->user_status == 1){
			$update = array('user_status'=>2);
		}else{
			$update = array('user_status'=>1);
		}
		DB::table(TBL_USER)
			->where('user_id',$id)
			->update($update);
		session()->flash('success','User status change successfully');
		return redirect('admin-sellers-list');
	}
	public function seller_approve($id){
		$user = DB::table(TBL_USER)
					->where('user_id',$id)
					->where('is_email_verified',1)
					->first();
		if($user->user_status == 0){
			$update = array('user_status'=>1);
		}
		$mailIdForSeller=$user->email;
		$nameOfSeller=$user->first_name.' '.$user->last_name;
		//fire a mail to approve that seller account
		 $mailSubject='Account approved';
		Mail::send(new userMail($mailIdForSeller,$nameOfSeller,$mailSubject));
			DB::table(TBL_USER)
				->where('user_id',$id)
				->update($update);
		session()->flash('success','Successfully approved.');
		return redirect('admin-sellers-list');
	}
	public function customer_delete($id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		$update = array('user_status'=>3);
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','User deleted successfully');
		return redirect('admin-customers-list');
	}
	public function seller_delete($id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		$update = array('user_status'=>3);
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','User deleted successfully');
		return redirect('admin-tradesmen-list');
	}
	public function admin_multi_delivery_staff_change_status(Request $request){
		if(@$request->user){
			$nothingToChangeFlag=true;
			$arrOfUsers=$request->user;			
			if(@$request->action=='Inactive'){
				//users status=1 //active users				
					foreach($arrOfUsers as $userId){
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)									
									->where('user_status',1)
									->first();
						if(count($user)){							
							//update the user status 1 to 2 and so show the user status as inactive.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>2));
						$nothingToChangeFlag=false;
						}		
					}
			}
			elseif(@$request->action=='Active'){
					foreach($arrOfUsers as $userId){
					//only users status=2 //for inactive users	
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)									
									->where('user_status',2)
									->first();
						if(count($user)){							
							//update the user status 2 to 1 and show the user status as active.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>1));
						$nothingToChangeFlag=false;		
						}		
					}
			}
			if($nothingToChangeFlag){
				session()->flash('info','Nothing to change.');
				return redirect('admin-delivery-staff-list');	
			}
			session()->flash('success','Users status change successfully.');
		    return redirect('admin-delivery-staff-list');
		}else{
		 return redirect('admin-delivery-staff-list');
		}
	}
	public function package_list(Request $request)
	{
		$package = DB::table(TBL_PACKAGE)->get();
		$data = array('package'=>$package);
		return view('admin.package_list',$data);
	}
	public function package_add(Request $request)
	{
		return view('admin.add_package');
	}
}
