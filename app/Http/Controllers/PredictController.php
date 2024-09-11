<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredictSubcategoryRequest;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Traits\Utils;

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

        if ($quantity > 0 && $quantity <= 100) {
            $min = 0.01;
            $max = 100;
        } else if ($quantity > 100 && $quantity <= 250) {
            $min = 100.01;
            $max = 250;
        } else if ($quantity > 250 && $quantity <= 500) {
            $min = 250.01;
            $max = 500;
        } else if ($quantity > 50 && $quantity <= 1000) {
            $min = 500.01;
            $max = 1000;
        } else if ($quantity > 1000 && $quantity <= 2500) {
            $min = 1000.01;
            $max = 2500;
        } else if ($quantity > 2500 && $quantity <= 5000) {
            $min = 2500.01;
            $max = 5000;
        } else if ($quantity > 5000 && $quantity <= 7500) {
            $min = 5000.01;
            $max = 7500;
        } else if ($quantity > 7500 && $quantity <= 10000) {
            $min = 7500.01;
            $max = 10000;
        } else if ($quantity > 10000 && $quantity <= 25000) {
            $min = 10000.01;
            $max = 25000;
        } else if ($quantity > 25000 && $quantity <= 50000) {
            $min = 25000.01;
            $max = 50000;
        } else if ($quantity > 50000 && $quantity <= 75000) {
            $min = 50000.01;
            $max = 75000;
        } else if ($quantity > 75000 && $quantity <= 100000) {
            $min = 75000.01;
            $max = 100000;
        } else
            $min = 100000.01;

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
}
