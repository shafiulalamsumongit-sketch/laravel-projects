<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'short_description' => $this->short_description,
            'price'             => (float) $this->price,
            'sale_price'        => $this->sale_price ? (float) $this->sale_price : null,
            'discount_percent'  => $this->discount_percent,
            'sku'               => $this->sku,
            'stock_quantity'    => $this->stock_quantity,
            'in_stock'          => $this->stock_quantity > 0,
            'is_featured'       => $this->is_featured,
            'rating'            => (float) $this->rating,
            'reviews_count'     => $this->reviews_count,
            'category'          => new CategoryResource($this->whenLoaded('category')),
            'images'            => ProductImageResource::collection($this->whenLoaded('images')),
            'primary_image'     => $this->primary_image,
            'reviews'           => ReviewResource::collection($this->whenLoaded('reviews')),
            'variants'          => ProductVariantResource::collection($this->whenLoaded('variants')),
            'created_at'        => $this->created_at,
        ];
    }
}
