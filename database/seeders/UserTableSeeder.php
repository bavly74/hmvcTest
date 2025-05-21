<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'), // hashed password
        ]);
        $admin->roles()->attach($adminRole->id);

            $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('123456789'),
        ]);
        $user->roles()->attach($userRole->id);

    }
}
