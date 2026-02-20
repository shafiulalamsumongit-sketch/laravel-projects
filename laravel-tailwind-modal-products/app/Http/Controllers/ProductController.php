<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // print_r($_SESSION);
        return view('products.index');
    }

    public function store(StoreProductRequest $request)  // with validation rule
    {
        try {
            $data = $request->validated();
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed for the code field.',
                'success' => false,
            ], 422);
        }

        // Auto-generate SKU if empty
        if (empty($data['sku'])) {
            $data['sku'] = 'SKU-' . strtoupper(Str::random(8));
        }

        $mainImage = $request->file('main_image')->store('products', 'public');
        $subImages = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                $subImages[] = $image->store('products', 'public');
            }
        }

        $product = Product::create([
            // 'category_id' => $request->categories,
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'main_image' => $mainImage,
            'sub_images' => $subImages,
            //  'short_description' => $data['short_description'] ?? null,
            //   'description' => $data['description'] ?? null,
            //  'price' => $data['price'],
            //  'discount_price' => $data['discount_price'] ?? null,
            //  'status' => $data['status'],
        ]);

        // Basic conversion
        $categories = $request->categories;
        $categories = explode(',', $categories);  // Result: ["1", "2"]
        // $product->categories()->sync([$data['category_id']]);
        //  $categories = explode(',', $request->categories);
        $product->categories()->attach($categories);

        /*
         * if (!empty($data['tags'])) {
         *     $tagIds = collect($data['tags'])->map(function ($tag) {
         *         return Tag::firstOrCreate(['name' => $tag])->id;
         *     });
         *     $product->tags()->sync($tagIds);
         * }
         */

        return response()->json([
            'message' => 'Product created successfully.',
            'product' => $product->load('categories')
        ], 201);
    }
}
