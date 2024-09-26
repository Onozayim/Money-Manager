<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveExpenseRequest;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Traits\DateUtils;
use App\Traits\Utils;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    use Utils;
    use DateUtils;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function save(SaveExpenseRequest $request)
    {
        $period = $this->getActualPeriod();
        $month = Carbon::now()->month;
        $subCat = SubCategory::find($request->sub_category_id);

        $newExpense = Expense::create([
            'period' => $period,
            'month' => $month,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'sub_category_id' => $subCat->id,
            'category_id' => $subCat->category_id
        ]);

        return $this->returnDataJson($newExpense);
    }

    public function get()
    {
        $expenses = Expense::where('user_id', auth()->id())
            ->where('period', $this->getActualPeriod())
            ->orderBy('id', 'desc')
            ->get();

        return $this->returnDataJson($expenses);
    }
}
