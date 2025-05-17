<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('qweqwe'),
            'role' => 'admin'
        ]);

        // user
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('qweqwe'),
            'role' => 'user'
        ]);
    }
}
