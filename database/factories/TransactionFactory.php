<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $createdAt = fake()->dateTimeBetween('- 7 days', 'now');
        $types = ['income', 'expense'];

        return [
            'name' => fake()->title(),
            'amount' => rand(10000, 1000000),
            'category_id' => rand(1, 9),
            'type' => $types[array_rand($types)],
            'description' => fake()->sentence(),
            'user_id' => 1,
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),

        ];
    }
}
