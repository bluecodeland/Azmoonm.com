<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && ( Auth::user()->hasRole('superuser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('director') || Auth::user()->hasRole('finance_head') || Auth::user()->hasRole('finance_assistant') ) )
        {
            return $next($request);
        }

        return redirect('restricted');
    }
}
