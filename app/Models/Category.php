<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Str;
class Category extends Model
{
    use HasFactory;


    protected $dates = ['created_at','updated_at'];
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute(){
        return ucwords($this->attributes['name']);
    }


    public function getCreatedAtAttribute(){
        $c = new Carbon($this->attributes['created_at']);
        return  $c->diffForHumans();
    }

    public function getUpdatedAtAttribute(){
    $c = new Carbon($this->attributes['updated_at']);
    return  $c->diffForHumans();
    }

}
