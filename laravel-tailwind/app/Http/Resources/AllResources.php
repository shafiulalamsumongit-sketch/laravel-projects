<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'name'=>$this->name,'slug'=>$this->slug,'description'=>$this->description,'image'=>$this->image ? asset('storage/'.$this->image) : null,'products_count'=>$this->whenCounted('products')];
    }
}

class ProductImageResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'url'=>asset('storage/'.$this->path),'alt_text'=>$this->alt_text,'sort_order'=>$this->sort_order];
    }
}

class ProductVariantResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'name'=>$this->name,'value'=>$this->value,'price_modifier'=>(float)$this->price_modifier,'stock_quantity'=>$this->stock_quantity,'sku'=>$this->sku];
    }
}

class ReviewResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'rating'=>$this->rating,'title'=>$this->title,'body'=>$this->body,'user'=>['id'=>$this->user->id,'name'=>$this->user->name],'created_at'=>$this->created_at];
    }
}

class CartResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'items'=>CartItemResource::collection($this->items),'total'=>$this->total,'item_count'=>$this->item_count];
    }
}

class CartItemResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'product'=>new ProductResource($this->product),'variant_id'=>$this->variant_id,'quantity'=>$this->quantity,'price'=>(float)$this->price,'subtotal'=>$this->subtotal];
    }
}

class OrderResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'order_number'=>$this->order_number,'status'=>$this->status,'payment_status'=>$this->payment_status,'subtotal'=>(float)$this->subtotal,'shipping_cost'=>(float)$this->shipping_cost,'tax'=>(float)$this->tax,'total'=>(float)$this->total,'items'=>OrderItemResource::collection($this->whenLoaded('items')),'shipping_address'=>$this->whenLoaded('shippingAddress'),'created_at'=>$this->created_at];
    }
}

class OrderItemResource extends JsonResource {
    public function toArray(Request $request): array {
        return ['id'=>$this->id,'name'=>$this->name,'quantity'=>$this->quantity,'price'=>(float)$this->price,'subtotal'=>$this->quantity * $this->price,'product'=>new ProductResource($this->whenLoaded('product'))];
    }
}
