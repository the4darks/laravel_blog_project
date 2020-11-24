@extends('layouts.post')

@section('content')
@if ($posts->count() == 0)
     <h3 class="text-center text-secondary">No Posts</h3>
        @else
        @php
         $id = 0;   
        @endphp
        
            <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Likes</th>
      <th scope="col">Photo</th>
      <th scope="col">Created At</th>
      <th scope="col">updated At</th>
      <th scope="col">show</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
   @foreach ($posts as $post)
    <tr>
      <th scope="row">{{ ++$id }}</th>
      <td>{{ $post->title }}</td>
      <td>{{ $post->user->name }}</td>
      <td>{{ $post->likes }}</td>
      <td><img style="width: 150px;height: 90px" src="{{ asset($post->photo) }}" alt="{{ $post->title }}"></td>
      <td>{{ $post->created_at->diffForHumans() }}</td>
      <td>{{ $post->updated_at->diffForHumans() }}</td>
      <td> <a class="btn btn-primary" href="{{ route('admin.post.show', $post->slug) }}"><i class="fa fa-eye" aria-hidden="true"></a></td>
      <td> <a class="btn btn-info" href="{{ route('admin.post.edit', $post->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td> <form action="{{ route('admin.post.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
      </form>
    </td>
    </tr>
     @endforeach

  </tbody>
</table>
       
@endif
    
{{ $posts->links() }}
@endsection