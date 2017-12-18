<?php
namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    public function index(Request $request)
	{
		//$data = array();
		$get_category = DB::table(TBL_JOB_CATEGORY)->paginate(20);
		$data = ['category'=>$get_category];
		//echo "<pre>";print_r($data['category']);die;
		return view('admin.category_list',$data);
    }
	public function add_category(Request $request){
		$get_category = DB::table(TBL_JOB_CATEGORY)->paginate(20);	
		if(@$request->category_name)
		{
			$insert_cat = array('category_name'=>$request->category_name);
			DB::table(TBL_JOB_CATEGORY)->insert($insert_cat);
			session()->flash('success','Category added successfully');
			return redirect('admin-category-list');
		}
		$data = ['category'=>$get_category];
		return view('admin.category_list',$data);
	}
	public function edit_category(Request $request,$id)
	{
		$get_category = DB::table(TBL_JOB_CATEGORY)->paginate(20);	
		$fetch_cat = DB::table(TBL_JOB_CATEGORY)->where('category_id',$id)->first();
		if(@$request->category_name)
		{
			$insert_cat = array('category_name'=>$request->category_name);
			DB::table(TBL_JOB_CATEGORY)->where('category_id',$id)->update($insert_cat);
			session()->flash('success','Category edited successfully');
			return redirect('admin-category-list');
		}
		$data = ['category'=>$get_category,'fetch_row'=>$fetch_cat];
		return view('admin.category_list',$data);
	}
	public function category_status($id){
		$fetch_cat = DB::table(TBL_JOB_CATEGORY)->where('category_id',$id)->first();
		if($fetch_cat->category_status == 0)
		{
			$update = array('category_status' =>1);
		}
		else
		{
			$update = array('category_status' =>0);
		}
		DB::table(TBL_JOB_CATEGORY)->where('category_id',$id)->update($update);
		session()->flash('success','Category status change successfully');
		return redirect('admin-category-list');
	}
	public function delete_category($id){
		$fetch_cat_user = DB::table(TBL_USER)->where('primary_trade',$id)->get();
		$fetch_cat_job = DB::table(TBL_JOB_TO_CATEGORY)->where('category_id',$id)->get();
		if(count($fetch_cat_user)>0 || count($fetch_cat_job)>0)
		{
			session()->flash('error','You can not delete this category, because this category is used.');
			return redirect('admin-category-list');
		}
		else
		{
			DB::table(TBL_JOB_CATEGORY)->where('category_id',$id)->delete();
			session()->flash('success','Category deleted successfully');
			return redirect('admin-category-list');
		}
	}
}
