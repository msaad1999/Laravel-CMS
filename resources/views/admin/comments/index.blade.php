@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Comments</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Comments
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>User</th>
        <th>Post</th>
        <th>Content</th>
        <th>Post Link</th>
        <th>Replies</th>
        <th>Moderation</th>
        <th>Delete</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($comments)
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>
                    <a href="{{ route('users.edit', $comment->user->id) }}">
                        {{ $comment->user->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('posts.edit', $comment->post->id) }}">
                        {{ $comment->post->title }}
                    </a>
                </td>
                <td>{{ $comment->body }}</td>
                <td>
                    <a href="{{ route('home.post', $comment->post->id) }}">
                        View Post
                    </a>
                </td>
                <td>
                    <a href="{{ route('replies.show', $comment->id) }}">
                        View Replies
                    </a>
                </td>
                <td>
                    @if($comment->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form=group">
                                {!! Form::submit('Block', ['class'=>'btn btn-default p-0 text-warning']) !!}
                            </div>

                        {!! Form::close() !!}
                    @elseif($comment->is_active == 0)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form=group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-default p-0 text-success']) !!}
                            </div>

                        {!! Form::close() !!}
                    @endif
                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

                        <div class="form=group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-default p-0 text-danger']) !!}
                        </div>

                    {!! Form::close() !!}
                </td>
                <td>{{ $comment->created_at->diffForHumans() }}</td>
                <td>{{ $comment->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection
