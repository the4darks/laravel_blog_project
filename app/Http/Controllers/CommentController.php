<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
      protected $fillable = [
        'user_id', 'post_id', 'parent_id', 'description'
    ];
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        Comment::create($input);

        return back();
    }
}
