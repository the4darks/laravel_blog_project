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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong> {{ $message}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
    <form action="{{ route('tags.update', $tag->id)}}" enctype="multipart/form-data" method="post">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Tag Name: </label>
            <input value="{{ $tag->name }}" name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
        </div>

        <div class="form-group">
            <button value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
