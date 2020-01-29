@extends('layouts.blog-post')

@section('content')

<div class="row px-5">

    <!-- Post Content Column -->
    <div class="col-lg-8">

      <!-- Title -->
      <h1 class="mt-4">{{ $post->title }}</h1>

      <!-- Author -->
      <p class="lead">
        by
        <a href="#">{{ $post->user->name }}</a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p>Posted on {{ $post->created_at->isoFormat('D MMMM, Y') }}</p>

      <hr>

      <!-- Preview Image -->
      <img class="img-fluid rounded py-3" src="{{ $post->photo->file }}" alt="">

      <hr>

      <!-- Post Content -->
      <div class="py-3">{!! $post->body !!}</div>
      <hr>

        @auth
            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    @if(Session::has('comment_status'))
                        <p class="text-{{ session('comment_status')['class'] }}">{{ session('comment_status')['message'] }}</p>
                    @endif

                    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="form-group">
                            {!! Form::textarea('body', null,  ['class'=>'form-control', 'rows'=>5]) !!}
                            @error('body')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form=group">
                            {!! Form::submit('Comment', ['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>

            @foreach($post->comments()->where('is_active', 1)->get() as $comment)



                <div class="media mb-4">
                    <div class="row">
                        <img class="d-flex mr-3 rounded-circle" width='50' height='50'
                            src="{{$comment->user->photo ? $comment->user->photo->file : $comment->user->defaultImage }}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0 text-capitalize">
                                {{ $comment->user->name }}
                                <span class="small">{{ $comment->created_at->diffForHumans() }}</span>
                            </h5>
                            {{ $comment->body }}

                            <div class="replies">
                                @foreach($comment->replies()->where('is_active', 1)->get() as $reply)

                                    <div class="media mt-4">
                                        <div class="row">
                                            <img class="d-flex mr-3 rounded-circle" width='50' height='50'
                                                    src="{{$reply->user->photo ? $reply->user->photo->file : $reply->user->defaultImage }}" alt="">
                                            <div class="media-body">
                                                <h5 class="mt-0 text-capitalize">
                                                    {{ $reply->user->name }}
                                                    <small class="small">{{ $reply->created_at->diffForHumans() }}</small>
                                                </h5>
                                                <p>{{ $reply->body }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button class="toggle-reply-form btn btn-default text-primary px-2 font-weight-bold small">Reply</button>
                    <button class="toggle-replies btn btn-default text-dark px-2 font-weight-bold small">Show Replies</button>
                </div>
                <div class="reply-form">
                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply', 'class'=>'my-4']) !!}

                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    {!! Form::text('body', null,  ['class'=>'form-control']) !!}
                                    @error('body')
                                        <span class="text-danger small">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form=group">
                                    {!! Form::submit('Reply', ['class'=>'btn btn-default text-primary font-weight-bold']) !!}
                                </div>
                            </div>
                            <div class="col-5 px-1"></div>
                        </div>
                    {!! Form::close() !!}
                </div>

                <hr class="mb-5" style="width:50%">

            @endforeach

        @endauth

    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

      <!-- Search Widget -->
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>

      <!-- Categories Widget -->
      <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#">Web Design</a>
                </li>
                <li>
                  <a href="#">HTML</a>
                </li>
                <li>
                  <a href="#">Freebies</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#">JavaScript</a>
                </li>
                <li>
                  <a href="#">CSS</a>
                </li>
                <li>
                  <a href="#">Tutorials</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Side Widget -->
      <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
          You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
      </div>

    </div>

</div>



@push('styles')
<style>

    .replies, .reply-form{
        display: none;
    }

</style>
@endpush

@push('scripts')
<script>

    $(document).ready(function() {
        $('.toggle-reply-form').click(function(){
            // alert('a');
            $(this).parent().next().slideToggle('fast');
        });
        $('.toggle-replies').click(function(){
            // alert('a');
            $(this).parent().prev().find('.replies').slideToggle('fast');
        });
    });

</script>
@endpush

@endsection
