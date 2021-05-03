@extends('layout.master')

@section('content')
<h1 class="bg-info">{{$category->name}}</h1>
<strong>{{$category->id}}</strong>
<strong>{{$category->created_at}}</strong>
@endsection