@extends('layout.master')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Category</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated At</th>
    </tr>
  </thead>
  <tbody>

    @forelse($products as $product)
    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->price}}</td>
      <td><a href="{{route('products.show_category',$product->id)}}">{{$product->category->name}}</a></td>
      <td>{{$product->created_at}}</td>
      <td>{{$product->updated_at}}</td>
    </tr>
    @empty
    {{'No Product'}}
    @endforelse
  </tbody>
</table>
@endsection