<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class CheckOwner
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (Auth::check() && Auth::user()->status == 2) {
//             return $next($request);
//         }

//         return redirect()->route('admin.dashboard')->with('error', 'Unauthorized access.');
//     }
// }
