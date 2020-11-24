<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole');
    }
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();

        if ($tags->count() == 0) {
            return redirect()->route('tags.create');
        }

        return view('admin.posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'tags' => 'required',
            'body' => 'required|string',
            'photo' => 'required|image',
        ]);

        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();

        $photo->move('uploads/posts', $newPhoto);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'tags' => $request->tags,
            'body' => $request->body,
            'photo' => 'uploads/posts/' . $newPhoto,
            'slug' => Str::slug($request->title),

        ]);
        $post->tag()->attach($request->tags);
        return back()->with('inserted', ' Post created Successfully');

    }

    public function show($slug)
    {
        $posts = Post::where('slug', $slug)->get();
        return view('admin.posts.show', compact('posts'));

    }

    public function edit(Post $post)
    {
        // dd($post);
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post'))->with('tags', $tags);

    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'tags' => 'required',
            'body' => 'required|string',

        ]);
        $post->title = $request->title;
        $post->body = $request->body;

        $post->slug = Str::slug($request->title);
        $post->tag()->attach($request->tags);
        if ($request->has('photo')) {

            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/posts', $newPhoto);
            $post->photo = 'uploads/posts/' . $newPhoto;

        }
        $post->save();
        return back()->with('updated', ' Post updated Successfully');

    }

    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        return back();
    }
}
