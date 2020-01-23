@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Post</h1>
    </div>

    <div class="row pb-5">
        <div class="col-sm-3">
            <img class="img-fluid rounded" src="{{ $post->photo ? $post->photo->file : $post->defaultImage }}" width=200 height=100>
        </div>

        <div class="col-sm-9">
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
                @error('title')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category: ') !!}
                {!! Form::select('category_id', [''=>'Choose Category'] + $categories, null, ['class'=>'form-control']) !!}
                @error('category_id')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Picture: ') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                @error('photo_id')
                <br>
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Content: ') !!}
                {!! Form::textarea('body', null,  ['class'=>'form-control', 'rows'=>5]) !!}
                @error('body')
                    <span class="text-danger small">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form=group">
                {!! Form::submit('Update Post', ['class'=>'btn btn-primary px-5']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::model($post, ['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

            <div class="form=group my-2">
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger px-5']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

</div>

@endsection

