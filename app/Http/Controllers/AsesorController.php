<?php

namespace App\Http\Controllers;

use App\Traits\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsesorController extends Controller
{
    //

    use Utils;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function distribution(Request $request)
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

        $cantidad = $request->cantidad;

        // Determinar el rango
        $rango = $this->determineRange($cantidad);


        Log::info($request);

        $cats = ($request->comida ? "comida-" : "") . ($request->necesidades ? "necesidades-" : "") . ($request->deseos ? "gustos-" : "") . ($request->ahorros ? "ahorros-" : "");

        $cats = rtrim($cats, "-");

        $percentages = $this->assignPercentages();

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
                'comida-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 70,
                ],
                'comida-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 10,
                    'ahorros' => 0,
                    'comida' => 90,
                ],
                'comida-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'comida' => 90,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 15,
                    'gustos' => 85,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 10,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'comida' => 80,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 20,
                    'ahorros' => 80,
                    'comida' => 0,
                ],
                'comida-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 10,
                    'gustos' => 30,
                    'ahorros' => 0,
                    'comida' => 60,
                ],
                'comida-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 0,
                    'ahorros' => 10,
                    'comida' => 70,
                ],
                'comida-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 20,
                    'ahorros' => 10,
                    'comida' => 70,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 20,
                    'ahorros' => 10,
                    'comida' => 50,
                ],
                // Opciones de una sola categoría
                'comida' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'comida' => 0,
                ],
            ],
            '5001 - 10000' => [
                'comida-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 60,
                ],
                'comida-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 30,
                    'ahorros' => 0,
                    'comida' => 70,
                ],
                'comida-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 25,
                    'comida' => 75,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 70,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 0,
                    'ahorros' => 15,
                    'comida' => 60,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 40,
                    'ahorros' => 15,
                    'comida' => 45,
                ],
                'comida-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'comida' => 40,
                ],
                'comida-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 20,
                    'comida' => 50,
                ],
                'comida-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 30,
                    'ahorros' => 20,
                    'comida' => 50,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 30,
                    'ahorros' => 20,
                    'comida' => 20,
                ],
                // Opciones de una sola categoría
                'comida' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'comida' => 0,
                ],
            ],
            '10001 - 15000' => [
                'comida-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 50,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 50,
                ],
                'comida-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'comida' => 60,
                ],
                'comida-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 35,
                    'comida' => 65,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 60,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 0,
                    'ahorros' => 25,
                    'comida' => 40,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 25,
                    'comida' => 25,
                ],
                'comida-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 35,
                    'ahorros' => 0,
                    'comida' => 40,
                ],
                'comida-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 20,
                    'comida' => 50,
                ],
                'comida-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 35,
                    'ahorros' => 30,
                    'comida' => 35,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 25,
                    'ahorros' => 30,
                    'comida' => 10,
                ],
                // Opciones de una sola categoría
                'comida' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'comida' => 0,
                ],
            ],
            '15001 - 22000' => [
                'comida-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 60,
                ],
                'comida-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 0,
                    'comida' => 50,
                ],
                'comida-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'comida' => 60,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 65,
                    'gustos' => 35,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 55,
                    'gustos' => 0,
                    'ahorros' => 45,
                    'comida' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 60,
                    'ahorros' => 40,
                    'comida' => 0,
                ],
                'comida-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'comida' => 40,
                ],
                'comida-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 20,
                    'comida' => 50,
                ],
                'comida-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 25,
                    'ahorros' => 20,
                    'comida' => 55,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 50,
                    'gustos' => 30,
                    'ahorros' => 20,
                    'comida' => 0,
                ],
                // Opciones de una sola categoría
                'comida' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'comida' => 0,
                ],
            ],
            '22001 - 30000' => [
                'comida-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 65,
                ],
                'comida-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 0,
                    'comida' => 50,
                ],
                'comida-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 50,
                    'comida' => 50,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 70,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 0,
                    'ahorros' => 35,
                    'comida' => 40,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 50,
                    'comida' => 0,
                ],
                'comida-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 20,
                    'gustos' => 30,
                    'ahorros' => 10,
                    'comida' => 40,
                ],
                'comida-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'comida' => 35,
                ],
                'comida-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 50,
                    'ahorros' => 40,
                    'comida' => 10,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 25,
                    'ahorros' => 30,
                    'comida' => 10,
                ],
                // Opciones de una sola categoría
                'comida' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'comida' => 0,
                ],
            ],
            '30001 y más' => [
                'comida-necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 30,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 70,
                ],
                'comida-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'comida' => 60,
                ],
                'comida-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'comida' => 60,
                ],
                'necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 65,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 40,
                    'gustos' => 0,
                    'ahorros' => 60,
                    'comida' => 0,
                ],
                'gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 45,
                    'ahorros' => 55,
                    'comida' => 0,
                ],
                'comida-necesidades-gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 40,
                    'ahorros' => 0,
                    'comida' => 25,
                ],
                'comida-necesidades-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 25,
                    'gustos' => 0,
                    'ahorros' => 40,
                    'comida' => 35,
                ],
                'comida-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 20,
                    'ahorros' => 40,
                    'comida' => 40,
                ],
                'necesidades-gustos-ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 35,
                    'gustos' => 25,
                    'ahorros' => 40,
                    'comida' => 0,
                ],
                // Opciones de una sola categoría
                'comida' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 100,
                ],
                'necesidades' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 100,
                    'gustos' => 0,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'gustos' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 100,
                    'ahorros' => 0,
                    'comida' => 0,
                ],
                'ahorros' => [
                    'user_id' => auth()->id(),
                    'necesidades' => 0,
                    'gustos' => 0,
                    'ahorros' => 100,
                    'comida' => 0,
                ],
            ],
        ];

        return $percentages; // Regresar la variable $percentages
    }
}
