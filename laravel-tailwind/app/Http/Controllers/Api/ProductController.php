<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')
            ->active()
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->in_stock) {
            $query->inStock();
        }

        $sortBy = $request->sort_by ?? 'created_at';
        $sortDir = $request->sort_dir ?? 'desc';
        $allowedSorts = ['price', 'name', 'created_at', 'reviews_avg_rating'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        }

        return response()->json($query->paginate($request->per_page ?? 12));
    }

    public function featured()
    {
        $products = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->take(8)
            ->get();

        return response()->json($products);
    }

    public function search(Request $request)
    {
        $request->validate(['q' => ['required', 'string', 'min:2']]);

        $products = Product::with('category')
            ->active()
            ->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                  ->orWhere('description', 'like', "%{$request->q}%")
                  ->orWhere('sku', 'like', "%{$request->q}%");
            })
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->paginate(12);

        return response()->json($products);
    }

    public function show(string $slug)
    {
        $product = Product::with(['category', 'reviews.user'])
            ->active()
            ->where('slug', $slug)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->firstOrFail();

        // Related products
        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->withAvg('reviews', 'rating')
            ->take(4)
            ->get();

        return response()->json(compact('product', 'related'));
    }
}
