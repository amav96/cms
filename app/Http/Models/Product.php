<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $hidden = ['created_at','updated_at'];

    public function category(){
        //relacion uno a uno
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getGallery(){
        //relacion muchos a uno
        return $this->hasMany(ProductGallery::class,'product_id','id');
        //o le pasas directamente 

        // return $this->hasMany(ProductGallery::class);

    }
}
