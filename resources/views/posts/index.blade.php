@extends('layouts.post')

@section('content')

    <h2>
        POSTS
    </h2>
    @if ($message = Session('noTags'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong> {{ $message}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
    @endif
{{-- 
<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="..." class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>    
    
    --}}

    @if ($message = Session::get('deleted'))
          <div class="alert alert-danger">{{$message}}</div>
    @endif
    @if ($posts->count() == 0)
        <h3 class="text-center text-secondary">No Posts available yet</h3>
        @else
        @foreach($posts as $post)
        <div class="card mb-3" style="max-width: 100%;">
  <div class="row">
    <div class="col-md-5">
    <img src="{{ asset($post->photo) }}" class="card-img " height="100%" alt="{{  $post->title }}">
    </div>
    <div class="col-md-7">
      <div class="card-body">
        <h5 class="card-title h1">{{  $post->title }}</h5>
        <p class="card-text">
            <a href="{{ route('profile.show', $post->user->name ) }}">{{ $post->user->name }} </a>
        </p>
        <p class="card-text">
            {{ Str::limit(  $post->body , 160) }}
        </p>
        <p class="card-text">Published <small class="text-muted"> {{  $post->created_at->diffForHumans() }}</small></p>
        <p class="card-text">Last updated <small class="text-muted"> {{  $post->updated_at->diffForHumans() }}</small></p>
        <p class="card-text">
          Tags:
           @php
               $tagCount = 0;
            @endphp
            @foreach($tags as $tag)
                
                @foreach($post->tag as $post_tag)
                
                    @if($tag->id == $post_tag->id)
                     @php ++$tagCount; @endphp
                        <label> {{  ($tagCount > 1) ? ', ' : null  }}  <a class="link" href="{{ route('search.by.name', $tag->name) }}">{{ $tag->name }}</a>  </label>
                    @endif
                    
                @endforeach
                
            @endforeach
            </p>
           <div class="test" style="display: flex;">
            <p class="card-text">
            <a href=" {{ route('posts.show1', $post->slug) }}" class="btn btn-primary">Read more</a>
        
        @if ($post->user->id == Auth::id() || Auth::check() &&  Auth::user()->role == 'admin' )
            <a href=" {{ route('posts.edit', $post->id) }}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <form style="margin-left: 5px"  action="{{ route('posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </form>
         @endif
        </p>
           </div>
      </div>
    </div>
  </div>
</div>

       
        
        

    @endforeach
    {{$posts->links()}}
    @endif

@endsection

