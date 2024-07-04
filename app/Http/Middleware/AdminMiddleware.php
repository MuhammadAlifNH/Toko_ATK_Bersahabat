<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        {
            if (Auth::check() && (Auth::user()->status == 1 || Auth::user()->status == 2)) {
                return $next($request);
            }
            
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }
    }
}