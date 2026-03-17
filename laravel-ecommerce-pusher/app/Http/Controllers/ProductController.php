<?php

namespace App\Http\Controllers;

use App\Events\ProductAdded;
use App\Http\Requests\StoreProductRequest;
use App\Jobs\SendProductCreatedMailJob;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function store(StoreProductRequest $request)  // with validation rule
    {
        try {
            $validated = $request->validated();
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed for the code field.',
                'success' => false,
            ], 422);
        }
        // Auto-generate SKU if empty
        if (empty($validated['sku'])) {
            $validated['sku'] = 'SKU-' . strtoupper(Str::random(8));
        }
        $mainImagePath = $request->file('main_image')->store('products', 'public');
        $subImages = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                $subImages[] = $image->store('products', 'public');
            }
        }
        $subImages = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $subImages[] = $image->store('products', 'public');
            }
        }
        $slug = $request->slug
            ? $this->generateUniqueSlug($request->slug)
            : $this->generateUniqueSlug($request->name);
        // Create product
        $product = Product::create([
            ...$validated,
            'slug' => $slug,
            'main_image' => $mainImagePath
        ]);
        // Upload gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                $path = $image->store('products/gallery', 'public');
                $product->images()->create([
                    'image' => $path,
                    'is_featured' => $index == 0,
                    'sort_order' => $index
                ]);
            }
        }
        // Basic conversion
        $categories = $request->categories;
        $categories = explode(',', $categories);  // Result: ["1", "2"]
        $product->categories()->sync($categories);
        SendProductCreatedMailJob::dispatch($product);

        /*
         * if (!empty($data['tags'])) {
         *     $tagIds = collect($data['tags'])->map(function ($tag) {
         *         return Tag::firstOrCreate(['name' => $tag])->id;
         *     });
         *     $product->tags()->sync($tagIds);
         * }
         */
        // broadcast
        broadcast(new ProductAdded($product))->toOthers();

        return response()->json([
            'message' => 'Product created successfully.',
            'product' => $product->load('categories')
        ], 201);
    }
}
