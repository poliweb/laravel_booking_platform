<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $clientRole = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
        $master = Role::firstOrCreate(['name' => 'master']);
        $admin = Role::firstOrCreate(['name' => 'admin']);

        $manage_users_permission = Permission::firstOrCreate(['name' => 'manage users']);
        $create_tool_users_permission = Permission::firstOrCreate(['name' => 'create tool']);
        $add_post_permission = Permission::firstOrCreate(['name' => 'add post']);

        $permissions = [
            $manage_users_permission,
            $create_tool_users_permission,
            $add_post_permission
        ];

        $admin->syncPermissions($permissions);

    }
}
