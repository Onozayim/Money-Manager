<?php

namespace Database\Factories;

use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //inRandomOrder
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => fake()->name(),
            'sub_category_id' => SubCategory::inRandomOrder()->first()->id,
            'quantity' => rand(50, 100000)
        ];
    }
}
