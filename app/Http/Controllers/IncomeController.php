<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Traits\DateUtils;
use App\Traits\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    //
    use Utils;
    use DateUtils;
    
    public function index() {
        return view('registrar-ingreso');
    }

    public function history()
    {
        $incomes = Income::where('user_id', auth()->id())
            // ->where('period', $this->getActualPeriod())
            ->orderBy('id', 'desc')
            ->get();
        return view('historico-ingreso', compact('incomes'));
    }

    public function update_ingreso(Request $request) {
        Income::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'quantity' => $request->monto,
                'description' => $request->descripcion,
            ]);

        return redirect('/historico-ingreso')->with('status', 'Ingreso guardado!');;
    }

    public function edit_ingreso($id) {
        $income = Income::where('id', $id)->first();

        return view('editar-ingreso', compact('income'))->with('status', 'Ingreso guardado!');;
    }

    public function delete_ingreso($id) {
        Income::where('id', $id)->delete();
        return redirect('/historico-ingreso')->with('status', 'Ingreso Eliminado!');;
    }

    public function save_ingreso(Request $request) {
        $period = $this->getActualPeriod();
        $month = Carbon::now()->month;

        $newIncome = Income::create([
            'period' => $period,
            'month' => $month,
            'quantity' => $request->monto,
            'description' => $request->descripcion,
            'user_id' => auth()->id(),
            'year' => Carbon::now()->year
        ]);

        return redirect('/registrar-ingreso')->with('status', 'Ingreso guardado!');;
    }
}
