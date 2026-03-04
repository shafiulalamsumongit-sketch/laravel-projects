<?php

namespace App\Policies;

use App\Models\Admin;

class AdminPolicy
{
    /**
     * Only Super Admin can view admin list
     */
    public function viewAny(Admin $user)
    {
        return $user->hasRole('super_admin');
    }

    /**
     * Only Super Admin can create admin
     */
    public function create(Admin $user)
    {
        return $user->hasRole('super_admin');
    }

    /**
     * Super Admin cannot be edited by others
     */
    public function update(Admin $user, Admin $admin)
    {
        // If target admin is super_admin and current user is not same person
        if ($admin->hasRole('super_admin') && $user->id !== $admin->id) {
            return false;
        }

        return $user->hasRole('super_admin');
    }

    /**
     * Prevent deleting super admin
     */
    public function delete(Admin $user, Admin $admin)
    {
        if ($admin->hasRole('super_admin')) {
            return false;
        }

        return $user->hasRole('super_admin');
    }
}
