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
          <li class="breadcrumb-item"><a href="#">Edit</a></li>
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
            <h3 class="tile-title">Edit Post</h3>
            <div class="tile-body">
              <form class="row" method="POST" action="{{ route('posts.update', $post->id) }}">
                @csrf
                @method('PUT')

                

                <div class="form-group col-md-12">
                  <label class="control-label">Title </label>
                   <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'has-error' : '' }}"   placeholder="Enter Title" value="{{$post->title}}">
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>   
                <div class="form-group col-md-12">
                  <label class="control-label">Description</label>
                 <textarea rows="9" cols="100" name="description"  id="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}">{!! $post->description !!}</textarea>
                                          <span class="text-danger">{{ $errors->first('description') }}</span>
                </div> 
              
                <div class="form-group col-md-12">
                  <label class="control-label">Tags</label>
                 <select class="form-control js-example-tokenizer {{ $errors->has('tags') ? 'has-error' : '' }}" name="tags[]" multiple="multiple">
                           @forelse( $tags as $tag )
                              
                                                  <option 
                                                  @forelse($post->tags as $postTag)
                                                  {{ $tag->title==$postTag->title ? 'selected' : '' }}
                                                  @empty
                                                  @endforelse
                                                  >{{$tag->title}}</option>
                                                  
                                                  @empty
                                                  @endforelse
                                                </select>
                                                 <span class="text-danger">{{ $errors->first('tags') }}</span>
</div>


                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    

    @endsection