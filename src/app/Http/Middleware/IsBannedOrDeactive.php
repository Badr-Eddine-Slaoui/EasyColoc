<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsBannedOrDeactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->is_banned) {
            Auth::logout();
            return redirect()->route('login.view')->with('error', 'You are banned');
        }

        if ($request->user()->status == 'DESACTIVE') {
            Auth::logout();
            return redirect()->route('login.view')->with('error', 'You are desactive');
        }
        
        return $next($request);
    }
}
