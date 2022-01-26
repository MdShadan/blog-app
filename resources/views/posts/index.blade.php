@extends('layout.app')
@section('content')
<div class="app-title">
        <div>
        <h1><i class="fa fa-file"></i> Post</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Post</a></li>
          <li class="breadcrumb-item"><a href="#">List</a></li>
        </ul> 
      </div>
      <div class="row">
      <div class="clearix">
      </div>
        <div class="col-md-12">
         @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

   @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
          <div class="tile">
            <h3 class="tile-title"> Post List</h3>
            <div class="tile-body">
            @forelse( $posts as $post) 
              <div class="card">
                <div class="card-header">
                <h4><a  href="{{route('posts.show', $post->slug)}}">{{ $post->title }}</a> </h4>
                <br>
                <p>Date: {{ date('d/m/Y', strtotime($post->created_at)) }}</p>
                 Tags:
               @forelse($post->tags as $tag)
               <span class="badge badge-danger">
                {{$tag->title}}
                </span>
                @empty
               @endforelse
                </div>
                <div class="card-body">
                  <h5 class="card-title">Author: {{$post->author->name}}</h5></br>
                  <p>Comments: {{$post->comments->count()}} </p>
                
                <div> 
                
                  {!! Str::limit($post->description, 350, $end='...') !!}
                </div>

                 @if (strlen(strip_tags($post->description)) > 350)
                   <a href="{{route('posts.show', $post->slug)}}" class="btn btn-info btn-sm">Read More</a>
                  @endif

                  @if($post->user_id == Auth::id())
                  <a  href="{{route('posts.edit',$post->id)}}"  class="btn btn-warning">Edit</a>
                 @if($post->comments->count() == 0)
                  <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                      <input type="hidden" name="_method" value="delete" />
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <button  class="btn btn-danger" type="submit">Delete</button>

                  </form>
                  @endif
                   @endif
                 
                </div>
              </div>
          
              <br>
              @empty

              @endforelse
             
            </div>
            {{ $posts->links() }}
          </div>
        </div>
    </div>
    

    @endsection