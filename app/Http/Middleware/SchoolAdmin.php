<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class SchoolAdmin
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->hasRole('schooladmin') ) 
        {
            return $next($request);
        }

        return redirect('restricted');
    }
}
