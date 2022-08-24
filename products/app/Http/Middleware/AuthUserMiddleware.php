<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Shop\Entity\Member;

class AuthUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $is_allow_access = false;

        $user_id = session()->get('user_id');

        if ( !is_null($user_id) ){
            $is_allow_access = true;
        }

        if ( !$is_allow_access ) {
            return redirect()->to('/user/auth/sign-in');
        }
        
        return $next($request);
    }
}
