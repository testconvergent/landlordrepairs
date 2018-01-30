<?php

namespace App\Http\Middleware;
use Closure;
use Session;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    public function handle($request, Closure $next)
    {      
        if($request->input('_token')) {           
            if (\Session::token() != $request->input('_token')) {                 
                
                return redirect()->guest('/login');
            }
        }
        return parent::handle($request, $next);
    }
    protected $except = [
       'admin-static-image','webhook/stripe'
    ];
}
