<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_user = new User();
        $admin_user->name = 'PoliWeb';
        $admin_user->email = 'admin@admin.su';
        $admin_user->password = Hash::make('123456789');
        $admin_user->role = 'admin';
        $admin_user->save();

        $admin_user->assignRole('admin');

    }
}
