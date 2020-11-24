@extends('layouts.post')

@section('content')
        @if(count($errors) > 0)
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>

        @endforeach
        </ul>
    @endif
    @if ($message = Session::get('inserted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong> {{ $message}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
    @endif
      @if ($message = Session('noTags'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong> {{ $message}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
    @endif
    <form action="{{ route('tags.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Tag name: </label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" >
        </div>

        <div class="form-group">
            <button value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
