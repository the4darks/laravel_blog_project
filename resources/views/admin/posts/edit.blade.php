@extends('layouts.post')

@section('content')
    @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>

            @endforeach
        </ul>
    @endif
    @if ($message = Session::get('updated'))
        <div class="alert alert-info">
            {{ $message }}
        </div>
    @endif
    <form action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data" method="post">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label >Title: </label>
            <input value="{{ $post->title }}" name="title" type="text" class="form-control"  placeholder="Title">
        </div>
        <div class="form-group">
         @foreach($tags as $tag)
                <input value="{{ $tag->id }}" name="tags[]" type="checkbox"

              @foreach ($post->tag as $post_tag)
                  @if ($tag->id == $post_tag->id)
                      checked
                  @endif
              @endforeach
                >
                <label >{{ $tag->name  }} </label>
            @endforeach

        </div>

        <div class="form-group">
            <label >Post Image:</label>
            <input value="{{ $post->photo }}" name="photo" type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>

        <div class="form-group">
            <label >Content</label>
            <textarea  name="body" class="form-control"  rows="5">{{ $post->body }}</textarea>
        </div>

        <div class="form-group">
            <button value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
