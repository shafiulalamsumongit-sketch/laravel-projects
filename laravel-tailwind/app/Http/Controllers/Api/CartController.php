<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        $subtotal = $items->sum('subtotal');
        $tax      = round($subtotal * 0.08, 2);
        $shipping = $subtotal >= 50 ? 0 : 9.99;
        $total    = $subtotal + $tax + $shipping;

        return response()->json(compact('items', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:1', 'max:99'],
            'attributes' => ['nullable', 'array'],
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock available'], 422);
        }

        $cartItem = CartItem::where('user_id', $request->user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $request->quantity;
            if ($newQty > $product->stock) {
                return response()->json(['message' => 'Not enough stock available'], 422);
            }
            $cartItem->update(['quantity' => $newQty]);
        } else {
            $cartItem = CartItem::create([
                'user_id'    => $request->user()->id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'attributes' => $request->attributes,
            ]);
        }

        return response()->json($cartItem->load('product'), 201);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);
        $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);

        if ($cartItem->product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock available'], 422);
        }

        $cartItem->update(['quantity' => $request->quantity]);
        return response()->json($cartItem->load('product'));
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);
        $cartItem->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }

    public function clear(Request $request)
    {
        CartItem::where('user_id', $request->user()->id)->delete();
        return response()->json(['message' => 'Cart cleared']);
    }
}
