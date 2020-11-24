<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole');
        
    }
    public function index()
    {
        $tags = Tag::latest()->paginate(5);

        return view('admin.tags.index', compact('tags'));
    }

   
    public function create()
    {
       return view('admin.tags.create');

    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        Tag::create([
            'name' => $request->name
        ]);

        return back()->with('inserted', ' Tag created Successfully');


    }


    
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));

    }

    
    public function update(Request $request, Tag $tag)
    {
       $this->validate($request, [
           'name' => 'required|string'
       ]);
       $tag = Tag::find($tag->id);
       $tag->name = $request->name;
       $tag->save();
       return back()->with('updated', ' Tag created Successfully');

    }

   
    public function destroy(Tag $tag)
    {
        Tag::find($tag->id)->delete();
    }
}
