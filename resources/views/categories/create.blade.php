@extends('layout.master')
@section('content')

@isset($errors)

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>
  @foreach($errors->all() as $error)
     {{$error}}
  @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endisset



@if(isset($name))
<form action="{{route('category_update',$id)}}" method="post">
@else
<form action="{{route('category_save')}}" method="post">
@endif
  @csrf
  <div class="form-group">
    <label>Category Name</label>
    <input type="name" class="form-control" name="name"
     placeholder="Enter category name" 
     value="{{$name ?? ''}}">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection