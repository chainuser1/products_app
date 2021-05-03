@extends('layout.master')

@section('content')
@if(isset($errors))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  @foreach($errors->all() as $error)
  <strong>Error</strong> {{$error}}<br>
  @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
@endif
</div>
<form action="{{route('products.store')}}" method="POST">
    @csrf
  <div class="form-group">
    <label >Name</label>
    <input type="text" class="form-control" value="{{old('name')}}" name='name'>
    
  </div>
  <div class="form-group">
    <label >Price</label>
    <input type="text" class="form-control" value="{{old('price')}}"  name='price'>
  </div>
  <div class="form-group">
    <label >Category</label>
    <select class="form-control" name="category_id">
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection