<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'created_by' => 1,
        ]);

        // Create Admin role
        $role = Role::create(['name' => 'Admin']);

        // Define admin permissions
        $adminPermissions = [
           'user-list',
'admin-reports',
'user-create',
'user-edit',
'user-delete',
'role-list',
'role-create',
'role-edit',
'role-delete',
'faqs',
'contact-us',
'settings',
'activity-logs',
'new-application',
'edit-application',
'delete-application',
'view-application',
'find-application',
'logs',
'permissions',
'users',
'roles',

        ];

        // Get permission models by their names
        $permissions = Permission::whereIn('name', $adminPermissions)->get();

        // Sync admin permissions to the Admin role
        $role->syncPermissions($permissions);

        // Assign the Admin role to the user
        $user->assignRole($role);
    }
}
