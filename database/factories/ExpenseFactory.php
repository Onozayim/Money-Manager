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
        $month = rand(1, 12);
        $year = intval(Carbon::now()->year) - 1;
        return [
            //inRandomOrder
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => fake()->name(),
            'sub_category_id' => $subCat->id,
            'quantity' => rand(50, 1000),
            'category_id' => $subCat->category_id,
            'period' => $year . '-' . $month,
            'year' => $year,
            'month' => $month
        ];
    }
}
