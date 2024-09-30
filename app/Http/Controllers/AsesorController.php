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

    public function distribution(Request $request) {
        /*
        
        REQUEST : {
            necesidades: true,
            deseos: true,
            ahorros: true,
            inversiones: true,
            cantidad: 10000
        }
        */

        Log::info($request);

        $cats = ($request->necesidades ? "necesidades-" : "") + ($request->deseos ? "deseos-" : "") + ($request->ahorros ? "ahorros-" : "") + ($request->inversiones ? "inversiones-" : "");


        $data = array(
            'user_id' => auth()->id(),
            'necesidades' => 0,
            'deseos' => 0,
            'ahorros' => 0,
            'inversiones' => 0,
        );

        

        return $this->returnDataJson($data);
    }
}
