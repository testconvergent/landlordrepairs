<?php
namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    Public function login(Request $request)
	{
		$this->validate($request,[
		'email'=>'required|email',
		'password'=>'required',
	    ]);
		//echo "<pre>";print_r($request->all());exit;
		$details = DB::table(TBL_USER)
					->where('email',$request->email)
					->where('password',md5($request->password))
					->where('user_type',1)
					->first();
		 
		if(count($details)>0)
		{
			if($details->user_status == 1)
			{
				session()->put('admin_id',$details->user_id);
				session()->put('admin_name',$details->user_name);
				return redirect('admin-dashboard');
			}
			else
			{
				session()->flash('success','You are not active user');
				return redirect('admin');
			}
		}
		else
		{
			session()->flash('success','Your email password does not match.');
			return redirect('admin');
		}
		return redirect('admin');
	}
	public function dashboard()
	{		
		//echo session()->get('admin_id');die;
		return view('admin.dashboard');
	}
	public function logout()
	{
		session()->put('admin_id','');
		session()->flash('success','You have successfully logout.');   		
		return redirect('admin');
	}
	public function change_password(Request $request)
	{
		$post_data = $request->all();
		//echo session()->get('admin_id');die;
		if(@$post_data)
		{
			$this->validate($request,[
			'curr_password'=>'required',
			'new_password'=>'required',
			'conf_password'=>'required',
			]);
			$request_curr_password 	= $request->curr_password;
			$request_new_password 	= $request->new_password;
			$request_conf_password 	= $request->conf_password;
			$curr_password = md5($request_curr_password);
			$user_data =DB::table(TBL_USER)
						->where('user_id',session()
						->get('admin_id'))
						->first();
			if($user_data->password==$curr_password)
			{
				if($request_new_password == $request_conf_password)
				{
					$update['password'] = md5($request_new_password);
					DB::table(TBL_USER)->where('user_id',session()->get('admin_id'))->update($update);
					session()->flash('success','Password has been changed successfully.'); 
					return redirect('admin-change-password');
				}
				else
				{
					session()->flash('error','Confirm password does not match.'); 
					return redirect('admin-change-password');
				}
			}
			else
			{
				session()->flash('error','Current password does not match.'); 
				return redirect('admin-change-password');
			}
		}
		return view('admin.change_password');
	}
	public function static_page_list()
	{
		
		$get_page = DB::table(TBL_STATIC_PAGE)->get();
		$data['page'] = $get_page;
		//echo "<pre>";print_r($get_page);die;
		return view('admin.static_page_list',$data);
	}
	public function edit_static_page(Request $request,$id)
	{
		if(@$request->all())
		{
			$update = array();
			$update['page_description'] = $request->page_description;
			$update['page_meta_title'] = $request->page_meta_title;
			$update['page_meta_description'] = $request->page_meta_description;
			DB::table(TBL_STATIC_PAGE)->where('page_id',$id)->update($update);
			session()->flash('success','Page edited successfully.');
			return redirect('admin-static-page-list');
		}
		$get_page = DB::table(TBL_STATIC_PAGE)->where('page_id',$id)->first();
		$data['page'] = $get_page;
		//echo "<pre>";print_r($get_page);die;
		return view('admin.edit_static_page',$data);
	}
	public function page_status($id){
		$page = DB::table(TBL_STATIC_PAGE)->where('page_id',$id)->first();
		if($page->page_status == 1)
		{
			$update = array('page_status'=>0);
		}
		else
		{
			$update = array('page_status'=>1);
		}
		DB::table(TBL_STATIC_PAGE)->where('page_id',$id)->update($update);
		session()->flash('success','Page status change successfully');
		return redirect('admin-static-page-list');
	}
	public function upload_image(Request $request)
	{
		//die;
		if($_FILES['file']){
		$errors= array();
		$file_name = $_FILES['file']['name'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$file_size = $_FILES['file']['size'];
		$file_type = $_FILES['file']['type'];
		
		$extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
		$allowedExts = array("jpeg", "jpg", "png");
		
		if(in_array($extension,$allowedExts) === FALSE){
			$errors[]="Extension not allowed, please choose a JPG or JPEG or PNG file.";
		}
		if(empty($errors) == TRUE){
			$file=date('YmdHis').'-'.rand(00000,99999).'.'.$extension;
			move_uploaded_file($file_tmp,base_path().'/text_editer/upload_image/'.$file);
			// Generate response.
			$response = array();
			$response['link'] = url('text_editer/upload_image/'.$file);
			echo json_encode($response);
		}else{
			print_r($errors);
		}
		}
		else{
		   echo "No file selected!";
		}
	}
}
