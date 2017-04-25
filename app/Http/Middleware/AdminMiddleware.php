<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

class AdminMiddleware
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
        if(( Auth::check()) && (Auth::user()->user_type === 0)){
            return $next($request);
        }
        else{
        return redirect()
            ->route('main.home')
            ->with(['msg' => '<b style="color: red;">YOU are not allowed to BE there!!</b>']);
        }
    }
}
