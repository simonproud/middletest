<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    //
    use Searchable;
    protected $fillable = [
        'title', 'description'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'first_invoice'
    ];
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'categories_products', 'product_id', 'category_id');
    }

     public function offers()
    {
        return $this->hasMany('App\Offer');
    }
}
