@extends('layout.master')

@section('content')

@if(session('message'))
<div class="alert alert-success" role="alert">
  {{session('message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<form class="form-inline"
 action="{{route('category.search')}}?">
  <div class="form-group">
    <label>Search Category</label>
    <input type="text" name="search" >
  </div>
</form>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated At</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
    <tr>
      <th scope="row">{{$category->id}}</th>
      <td><a href="{{route('category_show_products',$category->id)}}">{{$category->name}}</a></td>
      <td>{{$category->created_at}}</td>
      <td>{{$category->updated_at}}</td>
      <td><a href="{{route('category_edit',$category->id)}}">Edit</a></td>
      <td><a href="{{route('category_delete',$category->id)}}" >Delete</a></td>
    </tr>
   @endforeach
  </tbody>
</table>
@endsection