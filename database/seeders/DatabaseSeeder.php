<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Call your custom seeder class here
        // Call multiple seeders here
        $this->call([
            RolePermissionSeeder::class,
            UserPermissionSeeder::class,
            PermissionPermissionSeeder::class,
            CreateAdminUserSeeder::class,
            SiteSettingsSeeder::class,
            EmailSettingsSeeder::class,
            HomepageSettingsSeeder::class,
            PaymentGatewaySettingsSeeder::class,

        ]);

    }
}

