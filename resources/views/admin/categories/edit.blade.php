@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
    </div>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 py-4 text-left">
                {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    @error('name')
                        <span class="text-danger small">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row text-center">
                    <div class="col">
                        {!! Form::submit('Update Category', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}
                        {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
        </div>
        <div class="col-sm-4"></div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('categories.index') }}" class="btn btn-primary rounded text-white">&larr; Go Back</a>
    </div>

</div>

@endsection


