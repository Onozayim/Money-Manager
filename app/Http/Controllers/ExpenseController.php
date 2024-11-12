<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveExpenseRequest;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Traits\DateUtils;
use App\Traits\Utils;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    use Utils;
    use DateUtils;

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        return view('registrar-egreso');
    }
    
    public function update_egreso(Request $request) {
        Expense::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'quantity' => $request->monto,
                'description' => $request->descripcion,
                'sub_category_id' => $request->sub_categoria,
                'category_id' => $request->categoria,
            ]);

        return redirect('/historico-egreso')->with('status', 'Egreso guardado!');;
    }

    public function edit_egreso($id) {
        $expense = Expense::where('id', $id)->first();

        return view('editar-egreso', compact('expense'));
    }

    public function delete_egreso($id) {
        Expense::where('id', $id)->delete();
        return redirect('/historico-egreso')->with('status', 'Egreso eliminado!');;
    }

    public function expense_sub_categories(Request $request) {
        // $id = $request->id;
        // var_dump($id);
        $subcats = SubCategory::where('category_id', $request->get('id'))->get();

        return $this->returnDataJson($subcats);
    }

    public function save_egreso(Request $request) {
        $period = $this->getActualPeriod();
        $month = Carbon::now()->month;

        $newExpense = Expense::create([
            'period' => $period,
            'month' => $month,
            'quantity' => $request->monto,
            'description' => $request->descripcion,
            'user_id' => auth()->id(),
            'sub_category_id' => $request->sub_categoria,
            'category_id' => $request->categoria,
            'year' => Carbon::now()->year
        ]);

        return redirect('/registrar-egreso')->with('status', 'Egreso guardado!');
    }

    public function history()
    {
        $expenses = Expense::with('category', 'sub_category')->where('user_id', auth()->id())
            // ->where('period', $this->getActualPeriod())
            ->orderBy('id', 'desc')
            ->get();
        return view('historico-egreso', compact('expenses'));
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
        Log::info(auth()->id());
        Log::info($this->getActualPeriod());

        $expenses = Expense::where('user_id', auth()->id())
            ->where('period', $this->getActualPeriod())
            ->orderBy('id', 'desc')
            ->get();

        return $this->returnDataJson($expenses);
    }
}
