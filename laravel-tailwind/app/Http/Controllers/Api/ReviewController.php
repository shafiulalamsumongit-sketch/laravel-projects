<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Product $product)
    {
        $reviews = Review::with('user:id,name')
            ->where('product_id', $product->id)
            ->where('is_approved', true)
            ->latest()
            ->paginate(10);

        return response()->json($reviews);
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title'  => ['nullable', 'string', 'max:255'],
            'body'   => ['required', 'string', 'min:10'],
        ]);

        // Check user purchased this product
        $hasPurchased = $request->user()->orders()
            ->where('payment_status', 'paid')
            ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
            ->exists();

        if (!$hasPurchased) {
            return response()->json(['message' => 'You must purchase this product before reviewing it'], 403);
        }

        $alreadyReviewed = Review::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($alreadyReviewed) {
            return response()->json(['message' => 'You have already reviewed this product'], 422);
        }

        $review = Review::create([
            'user_id'    => $request->user()->id,
            'product_id' => $product->id,
            'rating'     => $request->rating,
            'title'      => $request->title,
            'body'       => $request->body,
            'is_approved'=> true,
        ]);

        return response()->json($review->load('user:id,name'), 201);
    }

    public function destroy(Request $request, Review $review)
    {
        if ($review->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted']);
    }
}
