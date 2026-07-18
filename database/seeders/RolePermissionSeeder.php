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
           'faqs', 'reports', 'contact-us', 'settings','activity-logs','new-application', 'edit-application', 'delete-application', 'view-application', 'find-application','logs','permissions','users','roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']); // ✅ Prevent duplicate entries
        }


    }
}
