<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $hidden = ['created_at','updated_at'];

    public function category(){
        //relacion uno a uno
        return $this->hasOne(Category::class,'id','category_id');
    }
}
