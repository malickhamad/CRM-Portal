<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'role-list', 'role-create', 'role-edit', 'role-delete',
           'faqs', 'reports', 'contact-us', 'settings','activity-logs','payment-history','category', 'customers-list','user-subscription','admin-reports','new-application',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']); // ✅ Prevent duplicate entries
        }


    }
}
