<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkRole
{

    public function handle(Request $request, Closure $next)
    {
        $user_role = Auth::user()->role;

        if ($user_role != 'admin') {
            return redirect()->back();
        }
        return $next($request);
    }
}
