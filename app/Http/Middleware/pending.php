<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class pending
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

        if (Session::get('SESS_USER_ID') == "")
        {
            Session::forget('SESS_USER_TYPE');
            Session::forget('SESS_USER_ID');
            Session::forget('SESS_PENDING_TERMS');

            // return redirect('login')->with(Auth::logout());

        }

        if (Session::get('SESS_USER_TYPE') == "agent" && Session::get('SESS_USER_ID') != "")
        {

            if (Session::get('SESS_PENDING_TERMS') == 'TRUE')
            {

                return redirect('/pending-agreements');

            }

        }

        return $next($request);
    }

}
