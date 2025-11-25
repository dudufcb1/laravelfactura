<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\DemoModePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Model => Policy mappings here if needed
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Registrar gates para modo demo
        Gate::define('create-resource', [DemoModePolicy::class, 'create']);
        Gate::define('update-resource', [DemoModePolicy::class, 'update']);
        Gate::define('delete-resource', [DemoModePolicy::class, 'delete']);
        Gate::define('view-resource', [DemoModePolicy::class, 'view']);
        Gate::define('view-any-resource', [DemoModePolicy::class, 'viewAny']);
    }
}