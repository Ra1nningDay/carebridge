<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // สร้างผู้ใช้ admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123')
            ]
        );

        // สร้างผู้ใช้ทั่วไป
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password123')
            ]
        );

        // กำหนดบทบาทให้กับผู้ใช้
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        if ($adminRole) {
            $admin->roles()->attach($adminRole->id);
        }

        if ($userRole) {
            $user->roles()->attach($userRole->id);
        }
    }
}
