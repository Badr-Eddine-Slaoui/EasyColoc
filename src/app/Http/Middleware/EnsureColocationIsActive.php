<?php

namespace App\Http\Middleware;

use App\Models\Colocation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureColocationIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $colocation = $request->route('colocation');
        if (!$colocation) {
            $colocationId = $request->route('colocationId');
            if (!$colocationId) {
                return redirect()->route('colocation.index')->with('error', 'Colocation not found');
            }
            $colocation = Colocation::find($colocationId);
        }
        if ($colocation) {
            if ($colocation->status == 'DESACTIVE') {
                return redirect()->route('colocation.index')->with('error', 'Colocation is desactive');
            }

            $member = $colocation->members()->where("user_id", Auth::id())->first();

            if ($member) {
                if ($member->left_at) {
                    return redirect()->route("colocation.index")->with("error","You are not a member of this colocation");
                }
            }
        }
        return $next($request);
    }
}
