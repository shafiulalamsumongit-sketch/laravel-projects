<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class VendorSampleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Create Vendor Role
        |--------------------------------------------------------------------------
        */

        $vendorRole = Role::firstOrCreate([
            'name' => 'vendor',
            'guard_name' => 'vendor'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Sample Vendors
        |--------------------------------------------------------------------------
        */

        $vendors = [
            [
                'name' => 'Vendor One',
                'email' => 'vendor1@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Vendor Two',
                'email' => 'vendor2@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Vendor Three',
                'email' => 'vendor3@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($vendors as $data) {

            $vendor = Vendor::firstOrCreate(
                ['email' => $data['email']],
                $data
            );

            $vendor->assignRole($vendorRole);
        }
    }
}

