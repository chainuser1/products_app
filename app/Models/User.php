<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon as Carbon;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $dates = ['updated_at','created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile(){
        return $this->hasOne(Profile::class);
    }


    public function getCreatedAtAttribute(){
        $created_at =  new Carbon($this->attributes['created_at']);
        return $created_at->diffForHumans();
    }

    public function setNameAttribute($value){
        $name = explode(' ',$value);
        $this->attributes['name'] = strtolower($name[0]);
    }

    public function getNameAttribute(){
        return strtolower($this->attributes['name']);
    }

}
