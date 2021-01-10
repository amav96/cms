<?php

namespace App\Http\Middleware;

use Closure,Auth;

class IsAdmin
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
        $user = Auth::user()->role;
        if($user === "admin"): 
            return $next($request);
        else: 
            return redirect('/');
        endif;
       
    }

  
}
