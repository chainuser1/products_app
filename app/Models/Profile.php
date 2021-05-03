<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['fullname','address','user_id',
                'created_at', 'updated_at'];
    protected $dates = ['created_at','updated_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function photos(){
        return $this->hasMany(UserPhoto::class);
    }
}
