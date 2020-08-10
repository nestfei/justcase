<?php

namespace App\Http\Middleware;

use Closure;

class AutoLogin
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
				//cookie('auth_cookie')が存在すれば、既にログインしたと判断する
        if($request->cookie('auth_cookie') || $request->cookie('lastname_cookie')){
					return $next($request);
				}
				//ログインしてもらう
				return redirect('loginPage');
    }
}
