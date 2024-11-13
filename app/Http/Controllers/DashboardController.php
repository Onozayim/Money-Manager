<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Linear;
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
        $hasLinear = Linear::where('user_id', auth()->id())->first();

        $gastos_mensuales = Expense::where('user_id', auth()->id())
            ->where('period', $this->getActualPeriod())
            ->sum('quantity');
        $ingresos_mensuales = Income::where('user_id', auth()->id())
            ->sum('quantity');

        if(auth()->user()->amount == 0)
            $objetivo_gasto = 0;
        else {
            $objetivo_gasto = (($gastos_mensuales * 100) / auth()->user()->amount) ?? 0;
            if($objetivo_gasto > 100) $objetivo_gasto = 100;
        }

        if($ingresos_mensuales == 0) $ingresos_gastados = 0;
        else {
            $ingresos_gastados = ($gastos_mensuales * 100) / $ingresos_mensuales;
            if($ingresos_gastados > 100) $ingresos_gastados = 100;
        }

        // var_dump($expenses);
        return view('dashboard', compact(
            'expenses', 
            'hasNecesidades',
            'hasAhorros',
            'hasDeseos',
            'hasInversiones',
            'hasLinear',
            'gastos_mensuales',
            'ingresos_mensuales',
            'objetivo_gasto',
            'ingresos_gastados'
        ));
    }
}
