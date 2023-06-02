<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@health-and-wellness.com',
            'role_id' => 1,
            'password' => hash::make('admin!@#')
        ]);
    }
}
