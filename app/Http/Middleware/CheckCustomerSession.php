<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class CheckCustomerSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   public function handle($request, Closure $next)
    {
				 $user=DB::table('users')
						->where('user_id',session()->get('user_id'))
						->where('user_type',3)
						->where('user_status',1)
						->first();
		if(count($user)){			
			return $next($request);
		}else{
			return redirect('404-not-found');
		}	
    }
}
