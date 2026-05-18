<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'okto@gmail.com'],
            [
                'name' => 'Oktovaaaaa',
                'email' => 'oktovaaaaa@gmail.com',
                'password' => Hash::make('Osvald8080.'),
                'role' => 'admin',
            ]
        );
        
    }
}
