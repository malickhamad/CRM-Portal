<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
         //Ensure User role exists before assigning permissions
         $userRole = Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);

         //Assign permissions to User role
         $userPermissions = [

            'user-list',
           'user-create',
           'user-edit',
           'user-delete' ,
           'assessment-user',
            'user-subscription',
           'reports',
           'practice-info',
         ];
         $userRole->syncPermissions($userPermissions);
    }
}
