<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //


    public function children(){
        return $this->hasMany( 'App\Category', 'parent', 'external_id' );
    }

    public function parent(){
        return $this->hasOne( 'App\Category', 'external_id', 'parent' );
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'categories_products', 'category_id', 'product_id');
    }
}
