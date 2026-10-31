<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@konserku.test'],
            [
                'name' => 'User KonserKu',
                'password' => Hash::make('User12345'),
                'role' => 'user',
            ]
        );
    }
}
