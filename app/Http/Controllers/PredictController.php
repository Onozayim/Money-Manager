<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredictSubcategoryRequest;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Traits\Utils;
use Illuminate\Support\Facades\Log;

class PredictController extends Controller
{
    use Utils;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function predictSubcategory(PredictSubcategoryRequest $request)
    {
        $quantity = $request->quantity;
        $min = null;
        $max = null;

        $quantity_ranges = [
            [0.01, 100],
            [100.01, 250],
            [250.01, 500],
            [500.01, 1000],
            [1000.01, 2500],
            [2500.01, 5000],
            [5000.01, 7500],
            [7500.01, 10000],
            [10000.01, 25000],
            [25000.01, 50000],
            [50000.01, 75000],
            [75000.01, 100000]
        ];
        
        $min = 100000.01; // Valor por defecto si no se cumple ningún rango
        
        foreach ($quantity_ranges as $range) {
            if ($quantity > $range[0] && $quantity <= $range[1]) {
                $min = $range[0];
                $max = $range[1];
                break;
            }
        }
        

        if ($min && $max) {
            $data = Expense::groupBy('category_id')
                ->selectRaw('count(*) as total, category_id')
                ->orderBy('total', 'desc')
                ->whereBetween('quantity', [$min, $max])
                ->first();

            if (!$data) $this->returnDataJson(SubCategory::first());

            $subCat = Expense::groupBy('sub_category_id')
                ->selectRaw('count(*) as total, sub_category_id')
                ->orderBy('total', 'desc')
                ->where('category_id', $data->category_id)
                ->whereBetween('quantity', [$min, $max])
                ->first();

            if (!$subCat) $this->returnDataJson(SubCategory::first());
        } else {
            $data = Expense::groupBy('category_id')
                ->selectRaw('count(*) as total, category_id')
                ->orderBy('total', 'desc')
                ->where('quantity', '>', $min)
                ->first();

            if (!$data) $this->returnDataJson(SubCategory::first());

            $subCat = Expense::groupBy('sub_category_id')
                ->selectRaw('count(*) as total, sub_category_id')
                ->orderBy('total', 'desc')
                ->where('category_id', $data->category_id)
                ->where('quantity', '>', $min)
                ->first();

            if (!$subCat) $this->returnDataJson(SubCategory::first());
        }

        return $this->returnDataJson(SubCategory::find($subCat->sub_category_id));
    }

    public function predictExpense()
    {
        $expenses = Expense::orderBy('id', 'desc')->latest()->take(100)->get();
        $expenses = $expenses->reverse();

        if (count($expenses) == 0) $this->returnDataJson(['value' => 100]);

        $n = 0;
        $sumX = 0;
        $sumY = 0;
        $sumXY = 0;
        $sumX2 = 0;

        foreach ($expenses as $ex) {
            $x = $ex->id;
            $y = $ex->quantity;

            $n++;
            $sumX += $x;
            $sumY += $y;
            $sumXY += $x * $y;
            $sumX2 += $x * $x;
        }

        $mediaY = $sumY / $n;
        $mediaX = $sumX / $n;


        // Calcular pendiente
        $m = (($sumXY) - (($sumX * $sumY) / $n)) / ($sumX2 - (($sumX * $sumX) / $n));
        // Calcular interseccion
        $b = ($mediaY - ($m * $mediaX));

        $prediccion = ($m * ($n + 1)) + $b;
        //Video de donde se obtuvo la formula https://www.youtube.com/watch?v=vP7Kvws9yFc        
        return $this->returnDataJson(['value' => round($prediccion, 2 )]);
    }
}
