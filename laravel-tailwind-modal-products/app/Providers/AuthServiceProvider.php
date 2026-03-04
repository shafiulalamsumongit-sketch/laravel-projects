<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Admin;
use App\Policies\AdminPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Admin::class => AdminPolicy::class,
        // \App\Models\Admin::class => \App\Policies\AdminPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
