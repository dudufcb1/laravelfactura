<?php

namespace App\Policies;

use App\Models\User;

class DemoModePolicy
{
    /**
     * Determine if the application is in demo mode
     */
    public function isDemoMode(): bool
    {
        return config('app.demo_site', false);
    }

    /**
     * Determine if user can create resources in demo mode
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can update resources in demo mode
     */
    public function update(?User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can delete resources in demo mode
     */
    public function delete(?User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view resources (always allowed)
     */
    public function view(?User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view any resources (always allowed)
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }
}
