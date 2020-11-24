@extends('layouts.app')

@section('content')

    @php
        $genderArray = ['Male','Female'];
        $citiesArray = ['Riyadh','Dammam','Sudier','Jeddeh','Makkah','Taif'];
    @endphp


    <div class="container" style="padding-top: 3%">

        @if (count($errors)>0)
            @foreach ($errors->all() as $item)
                <div class="alert alert-danger" role="alert">
                    {{$item}}
                </div>
            @endforeach

        @endif

        @if($message = Session::get('success'))
            <div class="alert alert-info">{{$message}}</div>
        @endif

        <form method="POST" action="{{route('profile.update')}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label > Name </label>
                <input type="text" name="name" class="form-control"  value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label > Twitter </label>
                <input type="text" name="twitter" class="form-control"  value="{{$user->profile->twitter}}">
            </div>
            <div class="form-group">
                <label > Gender </label>
                <select class="form-control" name="gender" >
                    @foreach ($genderArray  as $gender)
                        <option value="{{$gender}}" {{($user->profile->gender == $gender) ? 'selected':''}}>{{$gender}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label> City </label>
                <select class="form-control" name="city" >
                    @foreach ($citiesArray  as $city)
                        <option value="{{$city}}" {{($user->profile->city == $city) ? 'selected':''}}>{{$city}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Bio </label>
                <textarea class="form-control" name="bio" rows="3">{!! $user->profile->bio !!}</textarea>

            </div>


            <div class="form-group">
                <label> password </label>
                <input type="password" name="password" class="form-control" >
            </div>
            <div class="form-group">
                <label>confirm password </label>
                <input type="password" name="c_password" class="form-control"  >
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit"> Submit</button>
            </div>

        </form>
    </div>







@endsection
