<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap, FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand text-light" href="{{ route('posts.index') }}">
        <h1>Khalid's blog</h1>
    </a>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @guest
                <ul class="navbar-nav mr-5">
                 <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold" href="{{  route('login') }}"  role="button">
                       Login
                    </a>
                </li>
                 <li class="nav-item ">
                    <a class="nav-link text-light font-weight-bold" href="{{  route('register') }}"  role="button">
                       Register
                    </a>
                </li>
                </ul>
            @endguest
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-5">
                @auth
                {{-- Auth::check() &&  Auth::user()->role == 'admin' --}}
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Posts
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('posts.create') }}"><i class="fa fa-plus text-primary" aria-hidden="true"></i> Add a post</a>
                        @if (Auth::user()->role == 'admin')
                        <a class="dropdown-item" href="{{  route('admin.post.index') }}"><i class="fa fa-eye text-dark" aria-hidden="true"></i> Show posts</a>
                      @endif
                    </div>
                    
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tags
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{  route('tags.create') }}"><i class="fa fa-plus text-primary" aria-hidden="true"></i> Add a tag</a>
                        <a class="dropdown-item" href="{{  route('tags.index') }}"><i class="fa fa-eye text-dark" aria-hidden="true"></i> Show tags</a>
                    
                    </div>
                 
                    
                </li>
                @endif
                    
                {{-- Profile --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                          
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="grey" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                        </svg>
                        My profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <form  action="{{ route('logout') }}" method="post">
                            @csrf
                           <button type="submit" class="btn">
                               <span style="font-size: 1.3em;margin-left: -15px ">
                               <i class="fas fa-door-open text-danger"></i>
                               </span>
                              
                            Logout
                        </button>
                        </form>
                        
                        </a>
                        


                        
                        
                    </div>
                </li>
                @endauth

            </ul>
        </div>
    </nav>

</nav>

<div class="container my-5">
    @yield('content')
</div>
</body>
</html>
