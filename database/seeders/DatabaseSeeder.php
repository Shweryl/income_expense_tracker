<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Shwe Zin',
            'email' => 'shwezin@gmail.com',
            'password' => Hash::make('shwezin')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Veryl',
            'email' => 'veryl@gmail.com',
            'password' => Hash::make('veryl')
        ]);

        // Transaction::factory(10)->create();

    }
}
