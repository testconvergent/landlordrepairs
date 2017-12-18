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
			$users = $user->where('user_type',3)->where('user_status','!=',4)->orderBy('user_id', 'DESC')->paginate(25);
	    }
		else
		{
		   $users = $user->where('user_type',3)->where('user_status','!=',4)->orderBy('user_id', 'DESC')->paginate(25);
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
			$users = $user->where('user_type',2) ->where('user_status','!=',4) ->orderBy('user_id', 'DESC')->paginate(25);
		}
		else
		{
		   $users = $user->where('user_type',2)->where('user_status','!=',4)->orderBy('user_id', 'DESC')->paginate(25);
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
	public function customer_approve($id){
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		if($user->user_status == 0)
		{
			$update = array(
			'user_status'=>1,
			'phone_vcode'=>null,
			'email_vcode'=>null,
			'is_email_verified'=>1,
			'is_phone_verified'=>1
			);
			DB::table(TBL_USER)->where('user_id',$id)->update($update);
			session()->flash('success','User status change successfully');
		}
		else
		{
			
		}
		return redirect('admin-customers-list');
	}
	public function tradesmen_approve($id){
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		if($user->user_status == 0)
		{
			$update = array(
			'user_status'=>1,
			'phone_vcode'=>null,
			'email_vcode'=>null,
			'is_email_verified'=>1,
			'is_phone_verified'=>1
			);
			DB::table(TBL_USER)->where('user_id',$id)->update($update);
			session()->flash('success','User status change successfully');
		}
		return redirect('admin-tradesmen-list');
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
			$get_portfolio = DB::table(TBL_USER_TO_PORTFOLIO)->where('user_id',$id)->get();
			$get_logo = DB::table(TBL_USER_TO_LOGO)->where('user_id',$id)->get();
			$data = ['user'=>$users,'portfolio'=>$get_portfolio,'logo'=>$get_logo];
			return view('admin.tradesmen_details',$data);
		}
		else
		{
			return redirect('admin-tradesmen-list');
		}
	}
	public function customer_delete($id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		$update = array('user_status'=>4);
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','User deleted successfully');
		return redirect('admin-customers-list');
	}
	public function tradesmen_delete($id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$id)->first();
		$update = array('user_status'=>4);
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','User deleted successfully');
		return redirect('admin-tradesmen-list');
	}
	public function package_list(Request $request)
	{
		$package = DB::table(TBL_PACKAGE)->get();
		$data = array('package'=>$package);
		return view('admin.package_list',$data);
	}
	public function edit_package(Request $request,$id)
	{
		$get_package = DB::table(TBL_PACKAGE)->where('package_id',$id)->first();
		if(@$request->all())
		{
			$update_package = array();
			$update_package['package_type'] = $request->package_type;
			$update_package['cost'] = $request->cost;
			$update_package['credit_point'] = $request->credit_point;
			$update_package['package_description'] = $request->package_description;
			DB::table(TBL_PACKAGE)->where('package_id',$id)->update($update_package);
			session()->flash('success','Package edited sucessfully.');
		    return redirect('admin-package-list');
		}
		$data = array('package'=>$get_package);
		return view('admin.edit_package',$data);
	}
	public function package_status($id)
	{
		$get_package = DB::table(TBL_PACKAGE)->where('package_id',$id)->first();
		if($get_package->package_status == 1)
		{
			$update_package = array('package_status'=>0);
		}
		else
		{
			$update_package = array('package_status'=>1);
		}
		DB::table(TBL_PACKAGE)->where('package_id',$id)->update($update_package);
		session()->flash('success','Package edited sucessfully.');
		return redirect('admin-package-list');
	}
	public function change_credential(Request $request)
	{
		$post_data = $request->all();
		$user_data =DB::table(TBL_USER)->select('email')->where('user_id',session()->get('admin_id'))->first();
		
		//echo session()->get('admin_id');die;
		if(@$post_data)
		{
			$this->validate($request,[
			'user_name'=>'required',
			'new_password'=>'required',
			'conf_password'=>'required',
			]);
			$request_new_password 	= $request->new_password;
			$request_conf_password 	= $request->conf_password;
			if($request_new_password == $request_conf_password)
			{
				$update['password'] = md5($request_new_password);
				$update['email'] = $request->user_name;
				DB::table(TBL_USER)->where('user_id',session()->get('admin_id'))->update($update);
				session()->flash('success','Credential changed successfully.'); 
				return redirect('admin-change-credential');
			}
			else
			{
				session()->flash('error','Confirm password does not match.'); 
				return redirect('admin-change-credential');
			}
		}
		$data = array('admin'=>$user_data);
		return view('admin.change_admin_credential',$data);
	}
}
