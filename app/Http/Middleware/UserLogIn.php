<?php
namespace App\Http\Middleware;
use Closure;
class UserLogIn
{
    public function handle($request, Closure $next)
    {
		//echo 'hii';exit;
		if(!empty(session()->get('user_id')))
		{
			if(session()->get('user_type') == 2)
			{
				return redirect('my-profile');
			}
			else if(session()->get('user_type') == 3)
			{
				return redirect('my-jobs');
			}
		}
        return $next($request);
    }
}
