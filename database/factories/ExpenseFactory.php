<?php

namespace Database\Factories;

use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
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
        $subCat = SubCategory::inRandomOrder()->first();
        return [
            //inRandomOrder
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => fake()->name(),
            'sub_category_id' => $subCat->id,
            'quantity' => rand(50, 100000),
            'category_id' => $subCat->category_id,
            'period' => Carbon::now()->year . '-' . Carbon::now()->month
        ];
    }
}
