<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->user()->wishlist()->with('category')->withAvg('reviews', 'rating')->get();
        return response()->json($products);
    }

    public function toggle(Request $request, Product $product)
    {
        $result = $request->user()->wishlist()->toggle($product->id);
        $added  = count($result['attached']) > 0;
        return response()->json(['added' => $added, 'message' => $added ? 'Added to wishlist' : 'Removed from wishlist']);
    }
}
