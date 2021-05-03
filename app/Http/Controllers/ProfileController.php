<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Profile;
use App\Models\UserPhoto;
use Str;
class ProfileController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function show($id){
        $profile = Auth::user()->profile;
        $default =  'blank-profile-picture-973460_640.png';

        // UserPhoto::
        // where('profile_id', $profile->id)
        // ->orderByDesc('updated_at')
        // ->limit(1)
        // ->get()


        $photos = null;
        
        if(isset($profile->photos[0])){
            $photos=$profile->photos->sortByDesc('updated_at')->first()->get();
        }



        $photo = $photos?$photos[0]->filename:
                    $default;
        
        $directory = 'gallery/';
        $file = $photos?Auth::user()->name.'/'.$photo: $photo;

        return view('profile.show')
                ->withProfile($profile)
                ->withPhoto($directory.$file);

        
    }

    public function create(){
        if(Auth::user()->id){
            return view('profile.create');
        }
        return back();
    }


    public function store() {
        
        $req = request()->all();

        $validator = $this->validateProfile($req);

        if($validator->fails()){
            return back()->withErrors($validator->errors())
                        ->withInput();
        }
        
        $profile = Profile::create([
            'fullname' => request()->fullname,
            'address' => request()->address,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('profile.show',Auth::user()->id);

    }   

    public function edit($id){
        $profile = Profile::find($id);
        return view('profile.create')->withProfile($profile);
    }


    public function update($email,$id){
        $req = request()->all();

        $validator = $this->validateProfile($req);

        if($validator->fails()){
            return back()->withErrors($validator->errors())
                        ->withInput();
        }

        $profile = Auth::user()->profile;

        $profile->fullname = request()->fullname;
        $profile->address = request()->address;
        $profile->updated_at = now();
        $profile->save();

        return redirect()->route('profile.show',$id);

    }

    private function validateProfile($req){
        $validator =  Validator::make(
            $req,
            [
                'fullname' => 'required|regex:/^[\pL\s\-]+$/u',
                'address' => 'required',
            ],
            [
                'fullname.required' => 'Please provide your full name.',
                'fullname.alpha' => 'Name must be in Alpha Characters',
                'address' => 'Please provide your address',
            ]
        );

        return $validator;
    }
}
