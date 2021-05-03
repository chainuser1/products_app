<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPhoto;
use Auth;
use Str;
use Validator;
use Storage;
class UserPhotoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function upload(Request $request){

        // $request->validate(['file' => 'required|image']);
        $filename = md5(Auth::user()->email).time().'.'.$request->file->getClientOriginalExtension();
        
        $request->file->move(public_path('gallery/'
             .Str::snake(Auth::user()->name)),
              $filename);

        $uploaded = UserPhoto::create([
            'filename'=>$filename,
            'profile_id'=> Auth::user()->profile->id,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        
        return redirect()->route('profile.show', Auth::user()->id);

    }


    public function index(){
        $photos = Auth::user()->profile->photos;
        return view('photos.index')->withPhotos($photos);
    }


}
