<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('checkTags')->only('create');

    }
    public function index(Post $post)
    {
        $tags = Tag::all();
        $posts = $post::latest()->paginate(5);
        return view('posts.index', compact('posts'))->with('tags', $tags);
    }

    public function create()
    {

        $tags = Tag::all();
        return view('posts.create', compact('tags'));

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|unique:posts|min:5|max:30',
            'tags' => 'required',
            'body' => 'required|string|min:20',
            'photo' => 'required|image',

        ]);

        $photo = $request->photo;

        $newImage = time() . $photo->getClientOriginalName();

        $photo->move('uploads/posts', $newImage);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'photo' => 'uploads/posts/' . $newImage,
            'slug' => Str::slug($request->title),
        ]);

        $post->tag()->attach($request->tags);

        return back()->with('inserted', ' Post created Successfully');

    }

    public function show($slug)
    {
        $posts = Post::where('slug', $slug)->get();
        return view('posts.show', compact('posts'));

    }

    public function serachPostsByTag($name)
    {
        $tags = Tag::all();
          $tag = Tag::where('name', $name)->first();

          $posts = $tag->posts;
          return view('posts.postsbytag', compact('posts'))->with('tags', $tags);
        // dd($posts);
    }

    public function edit(Post $post)
    {

        $tags = Tag::all();

        return view('posts.edit', compact('post'))->with('tags', $tags);

    }

    public function update(Request $request, Post $post)
    {

        $this->validate($request, [
            'title' => 'required|string||min:5|max:30',
            'tags' => 'required',
            'body' => 'required|string|min:20',
        ]);
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->has('photo')) {

            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();

            $photo->move('uploads/posts', $newPhoto);
            $post->photo = 'uploads/posts/' . $newPhoto;
        }

        $post->slug = Str::slug($request->title);
        $post->tag()->sync($request->tags);
        $post->save();

        return back()->with('updated', ' Post updated Successfully');

    }

    public function like($id)
    {
        $post = Post::find($id);
        $post->likes = $post->likes += 1;
        $post->save();
        return back();

    }

    public function destroy(Post $post)
    {
        Post::find($post->id)->delete();

        return back()->with('deleted', 'Posted Deleted Successfuly');
    }
}
