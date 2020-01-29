@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Comment Replies</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        Comment By:
        <a href="{{route('users.edit', $comment->user->id)}}">
            {{ $comment->user->name }}
        </a>
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        <th>User</th>
        <th>Content</th>
        <th>Post</th>
        <th>Moderation</th>
        <th>Delete</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($comment->replies)
            @foreach($comment->replies as $reply)
            <tr>
                <td>{{ $reply->id }}</td>
                <td>
                    <a href="{{ route('users.edit', $reply->user->id) }}">
                        {{ $reply->user->name }}
                    </a>
                </td>
                <td>{{ $reply->body }}</td>
                <td>
                    <a href="{{ route('home.post', $reply->comment->post->slug) }}">
                        View Post
                    </a>
                </td>
                <td>
                    @if($reply->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form=group">
                                {!! Form::submit('Block', ['class'=>'btn btn-default p-0 text-warning']) !!}
                            </div>

                        {!! Form::close() !!}
                    @elseif($reply->is_active == 0)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form=group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-default p-0 text-success']) !!}
                            </div>

                        {!! Form::close() !!}
                    @endif
                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}

                        <div class="form=group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-default p-0 text-danger']) !!}
                        </div>

                    {!! Form::close() !!}
                </td>
                <td>{{ $reply->created_at->diffForHumans() }}</td>
                <td>{{ $reply->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection





