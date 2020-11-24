@extends('layouts.post')

@section('content')
    <h2>
        Tags
    </h2>
    <hr>
    
    <table class="table table-hover ">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">update</th>
            <th scope="col">delete</th>
        </tr>
        </thead>
        @php
            $id = 0;
        @endphp
    @foreach($tags as $tag)
            <tbody>
            <tr>
                <td>{{ ++$id }}</td>
                <td>{{ $tag->name }}</td>
                <td><a href=" {{ route('tags.edit', $tag->id) }}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td>
                <form  action="{{ route('tags.destroy', $tag->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
                </td>
            </tr>
            </tbody>
    @endforeach
    </table>
@endsection

