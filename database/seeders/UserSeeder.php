<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'mpksewagati@gmail.com',
            'password' => '$^*A23Z7!dHG^Eq2EG!l',
            'status_id' => 2,
        ]);

        $user->assignRole('Admin');

        $user = User::create([
            'name' => 'Muhammad Novel',
            'email' => 'mnovel78@gmail.com',
            'password' => 'B4ngs4d0',
            'status_id' => 2,
        ]);

        $user->assignRole('Admin');
    }
}
