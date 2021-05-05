<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['created_at','name',
    'updated_at','category_id','price'];
    // protected $attributes = ['created_at','updated_at'];
    protected $dates = ['created_at','updated_at'];
    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function getCreatedAtAttribute(){
            $c = new Carbon($this->attributes['created_at']);
            return  $c->diffForHumans();
    }

    public function getUpdatedAtAttribute(){
        $c = new Carbon($this->attributes['updated_at']);
        return  $c->diffForHumans();
    }

    public function setUpdatedAtAttribute(){
        // $this->attributes['created_at']  = Carbon::now();
    }
}
