@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Media</h1>
    </div>


    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@destroyMany']) !!}

    @component('layouts.components.datatable')
    @slot('title')
        All Images
        {!! Form::submit('Delete', ['name'=>'deleteMany', 'class'=>'btn btn-danger py-0 px-1 ml-5']) !!}
    @endslot
    @slot('headings')
        <tr>
        <th>{!! Form::checkbox('options', null, null, ['class'=>'checkAll']) !!} </th>
        <th>ID</th>
        <th>Image</th>
        <th>Type</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    @endslot
    @slot('body')
        @if($photos)
            @foreach($photos as $photo)
            <tr>
                <td>{!! Form::checkbox('checkBoxArray[]', $photo->id, null,  ['class'=>'checkBoxes']) !!}</td>
                <td><small>{{ $photo->id }}</small></td>
                <td><img src='{{ $photo->file }}' class="rounded" width=50 height=40></td>
                <td><small>{{ str_replace('_', ' ', $photo->type) }}</small></td>
                <td><small>{{ $photo->created_at->diffForHumans() }}</small></td>
                <td><small>{{ $photo->updated_at->diffForHumans() }}</small></td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

    {!! Form::close() !!}

</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.checkAll').on('click', function(){
                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                }
                else {
                    $('.checkBoxes').each(function(){
                    this.checked = false;
                    });
                }
            });
        });
    </script>
@endpush


