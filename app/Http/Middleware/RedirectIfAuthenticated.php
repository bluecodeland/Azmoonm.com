<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {

            if(Auth::user()->hasRole('superuser')) {
                return redirect('/admin');
            }

            if(Auth::user()->hasRole('admin')) {
                return redirect('/admin');
            }

            if(Auth::user()->hasRole('director')) {
                return redirect('/admin');
            }

            if(Auth::user()->hasRole('finance_head')) {
                return redirect('/admin');
            }

            if(Auth::user()->hasRole('finance_assistant')) {
                return redirect('/admin');
            }

            if(Auth::user()->hasRole('academic_head')) {
                return redirect('/academic');
            }

            if(Auth::user()->hasRole('academic_assistant')) {
                return redirect('/academic');
            }

            if(Auth::user()->hasRole('teacher')) {
                return redirect('/academic');
            }

            if(Auth::user()->hasRole('alumni')) {
                return redirect('/student');
            }

            if(Auth::user()->hasRole('student')) {
                return redirect('/student');
            }

            if(Auth::user()->hasRole('prospect')) {
                return redirect('/dashboard');
            }

            return redirect('/dashboard');
        }

        return $next($request);
    }
}