<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@vuemart.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Test customer
        User::create([
            'name'     => 'John Customer',
            'email'    => 'customer@vuemart.com',
            'password' => Hash::make('password'),
        ]);

        // Categories
        $categories = [
            ['name' => 'Electronics',    'slug' => 'electronics',    'sort_order' => 1],
            ['name' => 'Clothing',        'slug' => 'clothing',        'sort_order' => 2],
            ['name' => 'Home & Garden',   'slug' => 'home-garden',     'sort_order' => 3],
            ['name' => 'Sports & Outdoors','slug' => 'sports-outdoors', 'sort_order' => 4],
            ['name' => 'Books',           'slug' => 'books',           'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['is_active' => true]));
        }

        // Sample products
        $products = [
            ['name' => 'Wireless Noise-Cancelling Headphones', 'category_id' => 1, 'price' => 299.99, 'sale_price' => 249.99, 'stock' => 50, 'is_featured' => true],
            ['name' => 'Mechanical Gaming Keyboard',           'category_id' => 1, 'price' => 149.99, 'stock' => 75, 'is_featured' => true],
            ['name' => '4K Ultra HD Smart TV 55"',             'category_id' => 1, 'price' => 799.99, 'sale_price' => 649.99, 'stock' => 20, 'is_featured' => true],
            ['name' => 'Premium Running Sneakers',             'category_id' => 2, 'price' => 129.99, 'stock' => 100, 'is_featured' => true],
            ['name' => 'Classic Denim Jacket',                 'category_id' => 2, 'price' => 89.99, 'sale_price' => 69.99, 'stock' => 60],
            ['name' => 'Yoga Mat Premium',                     'category_id' => 4, 'price' => 49.99, 'stock' => 200, 'is_featured' => true],
            ['name' => 'Cast Iron Skillet 12"',                'category_id' => 3, 'price' => 59.99, 'stock' => 80],
            ['name' => 'The Art of Clean Code',                'category_id' => 5, 'price' => 39.99, 'stock' => 150, 'is_featured' => true],
        ];

        foreach ($products as $p) {
            $name = $p['name'];
            Product::create(array_merge($p, [
                'slug'              => Str::slug($name) . '-' . Str::random(4),
                'sku'               => strtoupper(Str::random(8)),
                'description'       => "Detailed description for {$name}. This is a high-quality product with excellent features.",
                'short_description' => "Premium {$name} with top-tier quality.",
                'images'            => ["/images/products/" . Str::slug($name) . ".jpg"],
                'is_active'         => true,
                'is_featured'       => $p['is_featured'] ?? false,
            ]));
        }

        echo "Database seeded successfully!\n";
    }
}
