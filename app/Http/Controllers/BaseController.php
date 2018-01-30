<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use view;
use DB;
use App\OrderDetails;
class BaseController extends Controller
{
    public function __construct(Request $request){		
        // $user_id =session()->get('user_id');
		//  $total_credit_point = ;
		//  view()->share('total_credit_point',$total_credit_point);
	}
}
