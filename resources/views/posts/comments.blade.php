{{-- @foreach ($comments as $comment)
    <div @if(!is_null($comment->parent_id)){
     style="margin-left: 60px;color:red"
    }
    @endif>
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->description }}</p>
    <form method="POST" action="{{route('comments.store')}}">
        @csrf
        <div class="form-group">
           <input type="text" class="form-control" name="description">
        <input type="hidden" class="form-control" name="post_id" value="{{$post_id}}">
           <input type="hidden" class="form-control" name="parent_id"  value="{{$comment->id}}">
         </div>
        <button type="submit" class="btn btn-primary">Reply</button>
      </form> 
      @include('posts.comments', ['comments'=>$comment->replies])
    </div>
    </div>
@endforeach --}}

<link
    href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    rel="stylesheet"
    id="bootstrap-css"
/>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
    .card-inner {
        margin-left: 4rem;
    }
</style>

<!--To Work with icons-->
<link
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous"
/>
@foreach ($comments as $comment)
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <p>
                        <a
                            class="float-left"
                            href="https://maniruzzaman-akash.blogspot.com/p/contact.html"
                            ><strong>{{ $comment->user->name }}</strong></a
                        >
                        {{-- <span class="float-right text-secondary text-center"
                            >15 Minutes Ago</span
                        > --}}
                    </p>
                    <div class="clearfix"></div>
                    <p>
                        {{ $comment->description }}
                    </p>
                    <br>
                    @include('posts.comments', ['comments'=>$comment->replies])
                  
                    <br>
                      <form  method="POST" action="{{route('comments.store')}}">
                        @csrf
                    <textarea   class="form-control" name="description"  ></textarea>
                       <input type="hidden" class="form-control" name="post_id" value="{{$post_id}}">
                       <input type="hidden" class="form-control" name="parent_id"  value="{{$comment->id}}">
                       <button type="submit" class="btn btn-primary">Reply</button>
                      </form>
                </div>
            </div>
       
        </div>
    </div>
</div>


@endforeach

{{-- <div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <p>
                        <a
                            class="float-left"
                            href="https://maniruzzaman-akash.blogspot.com/p/contact.html"
                            ><strong>Maniruzzaman Akash</strong></a
                        >
                        <span class="float-right text-secondary text-center"
                            >15 Minutes Ago</span
                        >
                    </p>
                    <div class="clearfix"></div>
                    <p>
                        Lorem Ipsum is simply dummy text of the pr make but also
                        the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s
                        with the release of Letraset sheets containing Lorem
                        Ipsum passages, and more recently with desktop
                        publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.
                    </p>
                    <p>
                        <a class="float-right btn btn-outline-primary ml-2">
                            <i class="fa fa-reply"></i> Reply</a
                        >
                    </p>
                </div>
            </div>
            <div class="card card-inner">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img
                                src="https://image.ibb.co/jw55Ex/def_face.jpg"
                                class="img img-rounded img-fluid"
                            />
                            <p class="text-secondary text-center">
                                15 Minutes Ago
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p>
                                <a
                                    href="https://maniruzzaman-akash.blogspot.com/p/contact.html"
                                    ><strong>Maniruzzaman Akash</strong></a
                                >
                            </p>
                            <p>
                                Lorem Ipsum is simply dummy text of the pr make
                                but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages,
                                and more recently with desktop publishing
                                software like Aldus PageMaker including versions
                                of Lorem Ipsum.
                            </p>
                            <p>
                                <a class="float-right btn btn-outline-primary ml-2">
																																				<i class="fa fa-reply"></i> Reply
																																			</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
