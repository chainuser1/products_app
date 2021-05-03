@extends('layout.master')

@section('content')
@if(count($errors->all()) > 0)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  @foreach($errors->all() as $error)
  <strong>Error!</strong> {{ $error}}
  @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<div>
<label>Email: <strong>{{Auth::user()->email}}</strong></label>

@if(isset($profile))
<form action="{{route('profile.update',[$profile->user->email,$profile->id])}}" method="post">
@else

<form action="{{route('profile.store')}}" method="post">

@endif



    @csrf
  <div class="form-group">
    <label>Fullname:</label>
    <input  value="{{old('fullname')}}" type="text" class="form-control col-md-6" name="fullname"  aria-describedby="nameHelp" placeholder="Enter name">
    <small id="nameHelp" class="form-text text-muted">Include given name and family name</small>
  </div>
 
  <div class="form-group">
  <label>Address</label>
  <textarea name="address"  class="form-control col-md-6" aria-describedby="addressHelp">
      {{old('address')}}
  </textarea>
  <small id="addressHelp" class="form-text text-muted">Include street and city</small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


@endsection