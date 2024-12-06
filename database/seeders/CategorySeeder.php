<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Food',
            'Transportation',
            'Clothes',
            'Entertainment',
            'Health',
            'Emergency Fund',
            'Personal Care',
        ];
        // $faker = Faker::create();
        foreach($categories as $category){
            Category::factory()->create([
                'name' => $category,
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ]);
        }
    }
}
