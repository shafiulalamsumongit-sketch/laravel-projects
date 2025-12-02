<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List products
    
    
        public function index25()
    {
        return response()->json([
            'status' => true,
            'products' => Product::all()
        ]);
    }
    
    
    public function index(Request $request)
    {
        
      //  return response()->json(['message'=>'Product show']);
        
        if ($request->user()->role === 'admin') {
            return Product::with('user')->get();
        }

        return $request->user()->products()->get();
    }

    // Create
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required',
            'category'=>'nullable',
            'price'=>'required|numeric',
            'description'=>'nullable'
        ]);

        $data['user_id'] = $request->user()->id;

        return Product::create($data);
    }

    // View
    public function show($id, Request $request)
    {
        $product = Product::findOrFail($id);

        if ($request->user()->role !== 'admin' && $product->user_id !== $request->user()->id) {
            return response()->json(['message'=>'Access Denied'],403);
        }

        return $product;
    }

    // Update
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->user()->role !== 'admin' && $product->user_id !== $request->user()->id) {
            return response()->json(['message'=>'Access Denied'],403);
        }

        $product->update($request->all());
        return $product;
    }

    // Delete
    public function destroy($id, Request $request)
    {
        $product = Product::findOrFail($id);

        if ($request->user()->role !== 'admin' && $product->user_id !== $request->user()->id) {
            return response()->json(['message'=>'Access Denied'],403);
        }

        $product->delete();
        return response()->json(['message'=>'Product Deleted']);
    }
}