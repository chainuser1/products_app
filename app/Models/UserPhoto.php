<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['filename','profile_id','created_at','updated_at'];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    
}
