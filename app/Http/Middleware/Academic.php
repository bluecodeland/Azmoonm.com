<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Academic
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && ( Auth::user()->hasRole('academic_head')  || Auth::user()->hasRole('academic_assistant')  || Auth::user()->hasRole('teacher') ) )
        {
            return $next($request);
        }

        return redirect('restricted');
    }
}
