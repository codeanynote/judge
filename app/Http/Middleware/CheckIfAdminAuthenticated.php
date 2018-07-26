<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth=Auth::guard('admins');
        if (Auth::user()->permission!=1) {
            var_dump($auth->user());
            return redirect('/');
        }

        /*if($auth->user()->isAdmin() != 1){
            return redirect(route('admin.auth.logout'));
        }*/

        return $next($request);
    }
}
