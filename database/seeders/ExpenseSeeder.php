<?php

namespace Database\Seeders;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Expense::factory(250)->state(new Sequence(
            ['month' => rand(1, 12)],
            ['month' => rand(1, Carbon::now()->month)],
            ['year' => intval(Carbon::now()->year) - 1],
            ['year' => intval(Carbon::now()->year)],
        ))->create();

        $expenses = Expense::all();

        foreach($expenses as $expense) {
            $expense->period = $expense->year . '-' . $expense->month;
            $expense->save();
        }
    }
}
