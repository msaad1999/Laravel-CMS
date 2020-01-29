@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Post</h1>
    </div>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}

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
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

</div>

@endsection

@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/components/summernote.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('scripts')
    {{-- <script src='{{ asset('js/components/summernote.min.js') }}'></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#body').summernote({
                height:300,
            });
        });
    </script>
@endpush

