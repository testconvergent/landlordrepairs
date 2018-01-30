<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\forgetPasswordMail;
class LoginController extends Controller
{   
    public function forget_password(Request $request){
		if(@$request->all()){
			$validation = array();
			$validation['email'] = 'required';
			$this->validate($request,$validation);
			$fetch_email = DB::table(TBL_USER)
								->where('email',$request->email)
								->where('user_status',1)
								->whereIn('user_type',[2,3])
								->first();
			if(count($fetch_email)>0){
                $passwordDetails = new \StdClass();               
				$passwordDetails->id_hash = md5($fetch_email->user_id);
				$passwordDetails->user_name = $fetch_email->user_name;
				$passwordDetails->user_email = $request->email;
                $passwordDetails->reset_url= url('reset-password/'.$passwordDetails->id_hash);               
                Mail::send(new forgetPasswordMail($passwordDetails));
				session()->flash('success','A reset password link has been sent to your email address.Please check your email and reset your password.');
				return redirect('forget-password');
			}else{
				session()->flash('msg','Opps! something went wrong.');
				return redirect('forget-password');
			}
		}
		return view('forget_password');
	}   
    public function reset_password($id,Request $request){
        $hashing=$id;
        $active_users=DB::table(TBL_USER)
                    ->where('user_status',1)
                    ->get();
        $find_hash=false;
        foreach($active_users as $item){
            if(md5($item->user_id)==$hashing){
                $find_hash=true;
                session()->put('set_user_id_for_reset_password',$item->user_id);
                break;
            }
        }
        if($find_hash){
            return view('reset_password');
        }
    }
    public function submit_reset_password(Request $request){
        if ($request->isMethod('post')) {
            $validation = array();
            $validation['password']='required';
            $validation['confirm_password']='required';
            $this->validate($request, $validation);
            $user_id=session()->get('set_user_id_for_reset_password');
            $password=md5($request->password);
            DB::table(TBL_USER)
                    ->where('user_id', $user_id)
                    ->update(array('password'=>$password));
           session()->flash('reset_password_message','Your password has been changed successfully.');         
           return redirect('login');
        }
    }

}
