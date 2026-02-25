<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'slug',
        'short_description',
        'description',
        'price',
        'discount_price',
        'stock',
        'status',
        'visibility',
        'seo_title',
        'seo_description',
        'weight',
        'dimensions',
        'publish_date',
        'main_image'
    ];

    protected $casts = [
        'sub_images' => 'array'
    ];

    // public function category() {
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

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
