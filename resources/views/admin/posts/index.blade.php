@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Posts</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Posts
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Post Link</th>
        <th>Comments</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($posts)
            @foreach($posts as $post)
            <tr>
                <td><small>{{ $post->id }}</small></td>
                <td><img src='{{ is_null($post->photo) ? $post->defaultImage : $post->photo->file }}' class="rounded" width=50 height=40></small></td>
                <td><small><a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a></small></td>
                <td><small><a href="{{ route('users.edit', $post->user->id) }}">{{ $post->user->name }}</a></small></td>
                <td><small>{{ $post->category ? $post->category->name : 'Uncategorized' }}</small></td>
                <td><small>
                    <a href="{{ route('home.post', $post->id) }}">
                        View
                    </a></small>
                </td>
                <td><small>
                    <a href="{{ route('comments.show', $post->id) }}">
                        View Comments
                    </a></small>
                </td>
                <td><small>{{ $post->created_at->diffForHumans() }}</small></td>
                <td><small>{{ $post->updated_at->diffForHumans() }}</small></td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection


