@extends('layouts.post')

@section('content')
    @if ($message = Session::get('inserted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong> {{ $message}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
    @endif
    <form action="{{ route('admin.post.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Title: </label>
            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"  placeholder="Title">
             @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
           @enderror
        </div>

        <div class="form-group">
            @foreach($tags as $tag)
                <input name="tags[]" type="checkbox" class="checkbox @error('tags') is-invalid @enderror" value="{{ $tag->id }}">
                <span> {{ $tag->name }} </span>
                @error('tags')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endforeach

        </div>


        <div class="form-group">
            <label for="exampleFormControlFile1">Post Image:</label>
            <input name="photo" type="file" class="form-control-file @error('photo') is-invalid @enderror" >
                @error('photo')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Content</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror"  rows="3"></textarea>
            @error('body')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="form-group">
            <button value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
