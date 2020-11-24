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

    @if ($message = Session::get('deleted'))
          <div class="alert alert-danger">{{$message}}</div>
    @endif
    @if ($posts->count() == 0)
        <h3 class="text-center text-secondary">No Posts available yet</h3>
        @else
    @php $postCount = -1 @endphp
        @foreach($posts as $post)
         @php $postCount++ @endphp
         
        <div class="card mb-3" style="max-width: 100%;">
  <div class="row ">
    <div class="col-md-5">
    <img src="{{ asset($posts[$postCount]->photo) }}" class="card-img " height="100%" alt="{{  $posts[$postCount]->title }}">
    </div>
    <div class="col-md-7">
      <div class="card-body">
        <h5 class="card-title h1">{{  $posts[$postCount]->title }}</h5>
        <p class="card-text">
            <a href="{{ route('profile.show', $posts[$postCount]->user->name ) }}">{{ $posts[$postCount]->user->name }} </a>
        </p>
        <p class="card-text">
            {{ Str::limit(  $posts[$postCount]->body , 160) }}
        </p>
        <p class="card-text">Published <small class="text-muted"> {{  $posts[$postCount]->created_at->diffForHumans() }}</small></p>
        <p class="card-text">Last updated <small class="text-muted"> {{  $posts[$postCount]->updated_at->diffForHumans() }}</small></p>
        <p class="card-text">
          Tags:
           @php
               $tagCount = 0;
            @endphp
            @foreach($tags as $tag)
                
                @foreach($posts[$postCount]->tag as $posts_tag)
                
                    @if($tag->id == $posts_tag->id)
                     @php ++$tagCount; @endphp
                        <label> {{  ($tagCount > 1) ? ', ' : null  }}  <a class="link" href="{{ route('search.by.name', $tag->name) }}">{{ $tag->name }}</a>  </label>
                    @endif
                    
                @endforeach
                
            @endforeach
            </p>
           <div class="test" style="display: flex;">
            <p class="card-text">
            <a href=" {{ route('posts.show1', $posts[$postCount]->slug) }}" class="btn btn-primary">Read more</a>
        
        @if ($posts[$postCount]->user->id == Auth::id() || Auth::check() &&  Auth::user()->role == 'admin' )
            <a href=" {{ route('posts.edit', $posts[$postCount]->id) }}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <form style="margin-left: 5px"  action="{{ route('posts.destroy', $posts[$postCount]->id) }}" method="post">
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
    {{-- {{$posts->links()}} --}}
    @endif

@endsection

