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
            'plans-list', 'plans-create', 'plans-edit', 'plans-delete',
            'plan-features-list', 'plan-features-create', 'plan-features-edit', 'plan-features-delete',
            'assessment', 'assessment-user', 'practice-info', 'faqs', 'reports', 'contact-us', 'settings','standards','activity-logs','payment-history','category', 'customers-list','user-subscription','admin-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']); // ✅ Prevent duplicate entries
        }


    }
}
