@extends('layout.master')


@section('content')
@if(Auth::user()->profile)



<div>
<div id="uploadpicture" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('image.upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class='py-3 form-group'>
          <label>Select File:</label>
          <input type="file" name="file" class="form-control">

        </div>

        
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary">Save changes</button>
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
      </form>
    </div>
  </div>
</div>

   <img data-toggle="modal" data-target="#uploadpicture" style="width:300px; height:300px; float:left;" 
       src="{{asset($photo)}}" alt="..." 
       class="img-thumbnail rounded mx-auto d-block">
  <a href="{{route('profile.edit',$profile->id)}}">Edit Profile, {{$profile->fullname}}</a>
  <h4 id="fullname">Name: {{$profile->fullname}}</h4>
  <a href="{{route('photos.index')}}">Show all Photos</a>
  <address id="address">Address: {{$profile->address}}</h4>
  <p>...</p>
  <a>Email: {{Auth::user()->email}}a>
  <p>...</p>

  <h4>Account Created: {{$profile->user->created_at}}</h4>
  <!-- <h4 id="list-item-4">Item 4</h4>
  <p>...</p> -->
</div>
@else

<div class="form-group py-3">
<a href="{{route('profile.create',Auth::user()->id)}}">Add Profile</a>
</div>

@endif

@endsection