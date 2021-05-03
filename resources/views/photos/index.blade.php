@extends('layout.master')

@section('content')
<style>

img{
    width: 300px;
    height:300px;
    margin: 4px 4px;
}

</style>


<div class="text-center">

@foreach($photos as $photo)
<img src="{{asset('gallery/'.strtolower(Auth::user()->name).'/'.$photo->filename)}}" class="img-thumbnail rounded float-left" alt="...">
@endforeach

</div>
@endsection