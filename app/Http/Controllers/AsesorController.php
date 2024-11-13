<?php

namespace App\Http\Controllers;

use App\Models\Percentages;
use App\Models\User;
use App\Traits\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsesorController extends Controller
{
    //

    use Utils;

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        return view('/generar-plan');
    }

    public function save(Request $request) {
        $cats = 0;

        if($request->necesidades) $cats++;
        if($request->deseos) $cats++;
        if($request->ahorros) $cats++;
        if($request->inversiones) $cats++;

        if($cats == 0) return redirect('/generar-plan')->with('error', 'Seleccione al menos una categoria');

        $this->distribution($request);

        $user = User::where('id', auth()->id())->first();
        $user->amount = $request->monto;
        $user->save();

        return redirect('/dashboard');
    }

    public function percentages() {

        $bgc = ['#4e73df', '#1cc88a', '#36b9cc', '#df4e4e'];
        $hbgc = ['#2e59d9', '#17a673', '#2c9faf', '#d92e2e'];
        $percentages = Percentages::with('category')->where('user_id', auth()->id())->get();

        $new_categories = [];
        $new_percentages = [];
        $new_bgc = [];
        $new_hbgc = [];

        foreach ($percentages as $percentage) {
            $new_categories[] = $percentage->category->name;
            $new_percentages[] = $percentage->percentage;
            $new_bgc[] = $bgc[$percentage->category_id - 1];
            $new_hbgc[] = $hbgc[$percentage->category_id - 1];
        }


        return $this->returnDataJson([
            'categories' => $new_categories,
            'percentages' => $new_percentages,
            'bgc' => $new_bgc,
            'hbgc' => $new_hbgc
        ]);
    }

    public function distribution($request)
    {
        /*
        
        REQUEST : {
            necesidades: true,
            deseos: true,
            ahorros: true,
            inversiones: true,
            cantidad: 10000
        }
        */

        $cantidad = $request->monto;

        // Determinar el rango
        $rango = $this->determineRange($cantidad);


        Log::info($request);

        $cats = ($request->inversiones ? "inversiones-" : "") . ($request->necesidades ? "necesidades-" : "") . ($request->deseos ? "gustos-" : "") . ($request->ahorros ? "ahorros-" : "");

        $cats = rtrim($cats, "-");

        $percentages = $this->assignPercentages();
        // dd($percentages[$rango][$cats]);

        $user_percentages = $percentages[$rango][$cats];

        Percentages::where('user_id', auth()->id())->delete();

        if($user_percentages['necesidades'] > 0) {
            Percentages::create([
                'user_id' => auth()->id(),
                'category_id' => 1,
                'percentage' => $user_percentages['necesidades']
            ]);
        }

        if($user_percentages['gustos'] > 0) {
            Percentages::create([
                'user_id' => auth()->id(),
                'category_id' => 2,
                'percentage' => $user_percentages['gustos']
            ]);
        }

        if($user_percentages['ahorros'] > 0) {
            Percentages::create([
                'user_id' => auth()->id(),
                'category_id' => 3,
                'percentage' => $user_percentages['ahorros']
            ]);
        }

        if($user_percentages['inversiones'] > 0) {
            Percentages::create([
                'user_id' => auth()->id(),
                'category_id' => 4,
                'percentage' => $user_percentages['inversiones']
            ]);
        }

        return $this->returnDataJson($percentages[$rango][$cats]);
    }

    private function determineRange($cantidad)
    {
        if ($cantidad <= 5000) return '0 - 5000';
        if ($cantidad <= 10000) return '5001 - 10000';
        if ($cantidad <= 15000) return '10001 - 15000';
        if ($cantidad <= 22000) return '15001 - 22000';
        if ($cantidad <= 30000) return '22001 - 30000';
        return '30001 y más';
    }

    private function assignPercentages()
    {
        // Definir las distribuciones para cada rango
        $percentages = [
            '0 - 5000' => [
                'inversiones-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 70,
                ],
                'inversiones-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 10,
                    'ahorros' => 0,
                    'inversiones' => 90,
                ],
                'inversiones-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'inversiones' => 90,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 85,
                    'gustos' => 15,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 90,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'inversiones' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 80,
                    'ahorros' => 20,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 10,
                    'ahorros' => 0,
                    'inversiones' => 60,
                ],
                'inversiones-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'inversiones' => 70,
                ],
                'inversiones-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 15,
                    'ahorros' => 10,
                    'inversiones' => 75,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 60,
                    'gustos' => 25,
                    'ahorros' => 15,
                    'inversiones' => 0,
                ],
                // Opciones de una sola categoría
                'inversiones' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 15,
                    'gustos' => 4,
                    'ahorros' => 1,
                    'inversiones' => 80,
                ],
            ],
            '5001 - 10000' => [
                'inversiones-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 60,
                ],
                'inversiones-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 30,
                    'ahorros' => 0,
                    'inversiones' => 70,
                ],
                'inversiones-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 25,
                    'inversiones' => 75,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 70,
                    'gustos' => 30,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 80,
                    'gustos' => 0,
                    'ahorros' => 20,
                    'inversiones' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 85,
                    'ahorros' => 15,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 10,
                    'ahorros' => 0,
                    'inversiones' => 60,
                ],
                'inversiones-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'inversiones' => 70,
                ],
                'inversiones-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 15,
                    'ahorros' => 10,
                    'inversiones' => 75,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 60,
                    'gustos' => 25,
                    'ahorros' => 15,
                    'inversiones' => 0,
                ],
                // Opciones de una sola categoría
                'inversiones' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 18,
                    'gustos' => 7,
                    'ahorros' => 5,
                    'inversiones' => 70,
                ],
            ],
            '10001 - 15000' => [
                'inversiones-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 50,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 50,
                ],
                'inversiones-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'inversiones' => 60,
                ],
                'inversiones-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 35,
                    'inversiones' => 65,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 60,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 65,
                    'gustos' => 0,
                    'ahorros' => 35,
                    'inversiones' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 70,
                    'ahorros' => 30,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 20,
                    'ahorros' => 0,
                    'inversiones' => 40,
                ],
                'inversiones-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 20,
                    'inversiones' => 50,
                ],
                'inversiones-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 25,
                    'ahorros' => 20,
                    'inversiones' => 55,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 50,
                    'gustos' => 30,
                    'ahorros' => 20,
                    'inversiones' => 0,
                ],
                // Opciones de una sola categoría
                'inversiones' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 15,
                    'ahorros' => 10,
                    'inversiones' => 50,
                ],
            ],
            '15001 - 22000' => [
                'inversiones-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 60,
                ],
                'inversiones-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 0,
                    'inversiones' => 50,
                ],
                'inversiones-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'inversiones' => 60,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 65,
                    'gustos' => 35,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 55,
                    'gustos' => 0,
                    'ahorros' => 45,
                    'inversiones' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 60,
                    'ahorros' => 40,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'inversiones' => 40,
                ],
                'inversiones-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 20,
                    'inversiones' => 50,
                ],
                'inversiones-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 25,
                    'ahorros' => 20,
                    'inversiones' => 55,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 50,
                    'gustos' => 30,
                    'ahorros' => 20,
                    'inversiones' => 0,
                ],
                // Opciones de una sola categoría
                'inversiones' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 20,
                    'ahorros' => 20,
                    'inversiones' => 35,
                ],
            ],
            '22001 - 30000' => [
                'inversiones-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 65,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 35,
                ],
                'inversiones-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 60,
                    'ahorros' => 0,
                    'inversiones' => 40,
                ],
                'inversiones-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 55,
                    'inversiones' => 45,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 60,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 45,
                    'gustos' => 0,
                    'ahorros' => 55,
                    'inversiones' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 50,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 35,
                    'ahorros' => 0,
                    'inversiones' => 30,
                ],
                'inversiones-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 0,
                    'ahorros' => 35,
                    'inversiones' => 40,
                ],
                'inversiones-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 20,
                    'ahorros' => 35,
                    'inversiones' => 45,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 25,
                    'ahorros' => 40,
                    'inversiones' => 0,
                ],
                // Opciones de una sola categoría
                'inversiones' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 30,
                    'ahorros' => 20,
                    'inversiones' => 30,
                ],
            ],
            '30001 y más' => [
                'inversiones-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 70,
                ],
                'inversiones-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'inversiones' => 60,
                ],
                'inversiones-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'inversiones' => 60,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 65,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 0,
                    'ahorros' => 60,
                    'inversiones' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 45,
                    'ahorros' => 55,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'inversiones' => 25,
                ],
                'inversiones-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'inversiones' => 35,
                ],
                'inversiones-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 20,
                    'ahorros' => 40,
                    'inversiones' => 40,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 25,
                    'ahorros' => 40,
                    'inversiones' => 0,
                ],
                // Opciones de una sola categoría
                'inversiones' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'inversiones' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'inversiones' => 0,
                ],
                'inversiones-necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 35,
                    'ahorros' => 25,
                    'inversiones' => 20,
                ],
            ],
        ];

        return $percentages; // Regresar la variable $percentages
    }
}
