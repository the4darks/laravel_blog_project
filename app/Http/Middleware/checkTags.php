<?php

namespace App\Http\Middleware;

use App\Models\Tag;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class checkTags
{

    public function handle(Request $request, Closure $next)
    {
        $tags = Tag::all();
        $user_role = Auth::user()->role;

        // if ($user_role != 'admin') {
        //     return redirect()->back();
        // }

        if ($tags->count() == 0 && $user_role == 'admin') {
            return redirect()->route('tags.create')->with('noTags', 'No tags available to create posts');
        }
        if ($tags->count() == 0 && $user_role != 'admin') {
            return back()->with('noTags', 'No tags available to create posts, Wait for admin to create some tags!');
           

        }
        return $next($request);

    }
}
