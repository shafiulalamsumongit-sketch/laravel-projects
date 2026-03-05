<?php

namespace App\Providers;

use App\Models\Admin;
use App\Policies\AdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Admin::class => AdminPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
        
        Gate::define('super-admin-access', function ($user) {
            return $user->hasRole('super_admin');
        });
    }
}
