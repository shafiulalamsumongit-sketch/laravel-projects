<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use App\Models\Tag;
use App\Models\User;

class Product extends Model
{

    protected $fillable = [
    'name',
    'sku',
    'main_image',
    'sub_images',
    'short_description',
    'description',
    'price',
    //'discount_price',
    'stock',
    'status',
    ///'category_id',
];


 /*    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'stock',
        'price',
        'main_image',
        'sub_images',
        'description'
    ];
 */



    protected $casts = [
        'sub_images' => 'array'
    ];

    //public function category() {
      //  return $this->belongsTo(Category::class);
   // }

public function categories()
{
    return $this->belongsToMany(Category::class);
}

public function tags()
{
    return $this->belongsToMany(Tag::class);
}





}