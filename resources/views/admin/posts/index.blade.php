@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Posts</h1>
    </div>

    @component('layouts.components.datatable'   )
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($posts)
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><img src='{{ is_null($post->photo) ? $post->defaultImage : $post->photo->file }}' class="rounded" width=50 height=40></td>
                <td><a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                <td><a href="{{ route('users.edit', $post->user->id) }}">{{  $post->user->name   }}</a></td>
                <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


