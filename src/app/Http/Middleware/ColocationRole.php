<?php

namespace App\Http\Middleware;

use App\Models\Colocation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ColocationRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $colocation = Colocation::active()->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id())
                ->whereNull('left_at');
        })->first();

        if (!$colocation) {
            return back()->with("error","You don't have permission to access this page");
        }

        if ($colocation->members()->where('user_id', Auth::id())->first()->role !== $role) {
            return back()->with("error","You don't have permission to access this page");
        }

        return $next($request);
    }
}
