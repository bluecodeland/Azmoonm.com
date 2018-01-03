<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Student
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && ( Auth::user()->hasRole('alumni') || Auth::user()->hasRole('student') ) )
        {
            return $next($request);
        }

        return redirect('restricted');
    }
}
