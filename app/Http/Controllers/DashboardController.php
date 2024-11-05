<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Percentages;
use App\Traits\DateUtils;
use App\Traits\Utils;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    use Utils;
    use DateUtils;

    public function index() {
        
        $expenses = Expense::with('category', 'sub_category')->where('user_id', auth()->id())
            ->where('period', $this->getActualPeriod())
            ->orderBy('id', 'desc')
            ->get();

        $hasNecesidades = Percentages::with('category')->where('user_id', auth()->id())->where('category_id', 1)->first();
        $hasAhorros = Percentages::with('category')->where('user_id', auth()->id())->where('category_id', 3)->first();
        $hasDeseos = Percentages::with('category')->where('user_id', auth()->id())->where('category_id', 2)->first();
        $hasInversiones = Percentages::with('category')->where('user_id', auth()->id())->where('category_id', 4)->first();

        // var_dump($expenses);
        return view('dashboard', compact(
            'expenses', 
            'hasNecesidades',
            'hasAhorros',
            'hasDeseos',
            'hasInversiones'
        ));
    }
}
