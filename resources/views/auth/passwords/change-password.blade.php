@extends('layout.app')
@section('content')
<div class="app-title">
        <div>
        <h1><i class="fa fa-file"></i> User</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{url('/posts')}}">User</a></li>
          <li class="breadcrumb-item"><a href="#">Change Password</a></li>
        </ul> 
      </div>
      <div class="row">
      <div class="clearix">
      </div>
        <div class="col-md-12">
          @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
          <div class="tile">
            <h3 class="tile-title">Change Password</h3>
            <div class="tile-body">
              <form class="row" method="POST" action="{{ route('ChangePassword') }}">
                @csrf

                

                <div class="form-group col-md-12">
                  <label class="control-label">Current Password </label>
                   <input type="password" name="current_password" class="form-control {{ $errors->has('current_password') ? 'has-error' : '' }}"  value="{{old('current_password')}}" placeholder="Enter Current Password">
                                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                </div> 

                <div class="form-group col-md-12">
                  <label class="control-label">New Password </label>
                   <input type="password" name="new_password" class="form-control {{ $errors->has('new_password') ? 'has-error' : '' }}"  value="{{old('new_password')}}" placeholder="Enter New Password">
                                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                </div> 

                <div class="form-group col-md-12">
                  <label class="control-label"> Confirm New Password </label>
                   <input type="password" name="new_password_confirmation" class="form-control {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}"  value="{{old('new_password_confirmation')}}" placeholder="Confirm New Password">
                                        <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
                </div>  
                
              
              


                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    

    @endsection