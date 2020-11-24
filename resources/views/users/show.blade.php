 @extends('layouts.post')

@section('content')

<div class="container">
<a  href="{{ route('posts.index') }}">&LeftArrow; Back</a>

 @foreach ($users as $user)
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   {{ $user->name }} 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Bio</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user->profile->bio }} 
                    </div>
                  </div>
                  <hr>
                
                
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">City</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $user->profile->city }}
                    </div>
                    
                  </div>
                  
                </div>
                 @if (!is_null($user->profile->twitter))
                 <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">{{$user->profile->twitter}}</span>
                  </li>
                </ul>
                @endif
                {{-- @foreach ($users as $user)
                    <span class="text-secondary">{{$user->posts->title}}</span>
                @endforeach --}}
                    

              </div>
            </div>
          </div>
        </div>
    </div>
@endforeach

@endsection 
