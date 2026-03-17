# VueMart — Laravel 11 Backend

Laravel 11 REST API + Blade Admin Dashboard for the VueMart e-commerce platform.

## Requirements
- PHP 8.2+
- Composer
- MySQL 8+
- Stripe account (for payments)

## Installation

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate app key
php artisan key:generate

# 4. Configure .env — set DB credentials + Stripe keys
DB_DATABASE=vuemart
DB_USERNAME=root
DB_PASSWORD=secret

STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...

FRONTEND_URL=http://localhost:5173

# 5. Run migrations + seed
php artisan migrate --seed

# 6. Start the server
php artisan serve
# API available at: http://localhost:8000
# Admin dashboard at: http://localhost:8000/admin
```

## Default Credentials
| Role     | Email                  | Password  |
|----------|------------------------|-----------|
| Admin    | admin@vuemart.com      | password  |
| Customer | customer@vuemart.com   | password  |

## Project Structure

```
laravel-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/          # REST API controllers (Sanctum auth)
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── CartController.php
│   │   │   │   ├── CheckoutController.php  (Stripe)
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── ReviewController.php
│   │   │   │   ├── WishlistController.php
│   │   │   │   └── UserController.php
│   │   │   └── Admin/        # Blade admin controllers
│   │   │       ├── DashboardController.php
│   │   │       ├── ProductController.php
│   │   │       ├── CategoryController.php
│   │   │       ├── OrderController.php
│   │   │       ├── CustomerController.php
│   │   │       └── ReviewController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── CartItem.php
│   │   ├── Review.php
│   │   └── Address.php
│   ├── Policies/
│   │   ├── CartItemPolicy.php
│   │   └── OrderPolicy.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
│   └── app.php               # Laravel 11 bootstrap (no kernel.php)
├── config/
│   ├── services.php           # Stripe config
│   ├── cors.php               # CORS for Vue frontend
│   └── sanctum.php
├── database/
│   ├── migrations/            # All table migrations
│   └── seeders/
│       └── DatabaseSeeder.php # Sample data
├── resources/views/
│   ├── layouts/
│   │   └── admin.blade.php    # Admin layout
│   └── admin/
│       ├── auth/login.blade.php
│       ├── dashboard/index.blade.php
│       ├── products/{index,create,edit}.blade.php
│       ├── orders/{index,show}.blade.php
│       ├── categories/{index,create}.blade.php
│       ├── customers/index.blade.php
│       └── reviews/index.blade.php
└── routes/
    ├── api.php                # API routes
    └── web.php                # Admin web routes

```

## API Endpoints

### Public
```
POST /api/register
POST /api/login
GET  /api/products
GET  /api/products/featured
GET  /api/products/search?q=
GET  /api/products/{slug}
GET  /api/categories
GET  /api/categories/{slug}/products
```

### Authenticated (Bearer token)
```
POST   /api/logout
GET    /api/user
PUT    /api/user
GET    /api/cart
POST   /api/cart
PUT    /api/cart/{id}
DELETE /api/cart/{id}
GET    /api/orders
GET    /api/orders/{id}
POST   /api/checkout/intent
POST   /api/checkout/complete
GET    /api/wishlist
POST   /api/wishlist/{product}
```

## Stripe Webhook
Configure your Stripe webhook to point to: `POST /api/stripe/webhook`
