@extends('layout.app')
@section('content')
<div class="app-title">
        <div>
        <h1><i class="fa fa-file"></i> Post</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{url('/posts')}}">Post</a></li>
          <li class="breadcrumb-item"><a href="#">Show</a></li>
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
@if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
          <div class="tile">
            <h3 class="tile-title">  {{ $post->title }}  </h3>
            <div class="tile-body">
            
              <div class="card">
                <div class="card-header">
                  <br>
                <p>Date: {{ date('d/m/Y', strtotime($post->created_at)) }}</p>
               Tags:
               @forelse($post->tags as $tag)
               <span class="badge badge-danger">
                {{ $tag->title }}
                </span>
                @empty
               @endforelse

                </div>
                <div class="card-body">
                  <h5 class="card-title">Author: {{ $post->author->name }}</h5>
                
                  @if($post->user_id == Auth::id())
                  <a  href="{{ route('posts.edit', $post->id) }}"  class="btn btn-warning">Edit</a>
                   @if($post->comments->count() == 0)
                  <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                      <input type="hidden" name="_method" value="delete" />
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <button  class="btn btn-danger" type="submit">Delete</button>
                  @endif
                  </form>
                   @endif
                  <div >
                    {!! $post->description !!}
                  </div>
                </div>
              </div>
              <br>

              <div class="card-body">
                <h5>All Comments</h5><br>
                @if( $post->comments->count()==0 )
                  <p class="text-danger">No comment added yet.</p>
                @endif
                @include('posts.replies', ['comments' => $post->comments, 'post_id' => $post->id])

                <hr />
               </div>

               <div class="card-body">
                <h5>Add Comment</h5>
                <form method="post" action="{{ route('comment.add') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control"  placeholder="Enter comment.." required/>
                        <input type="hidden" name="post_id" value="{{ $post->id }}"  />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                    </div>
                </form>
               </div>
             
            </div>
          </div>
        </div>
    </div>
    

    @endsection