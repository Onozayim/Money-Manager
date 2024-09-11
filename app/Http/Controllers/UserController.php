<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAmountRequest;
use App\Traits\Utils;

class UserController extends Controller
{
    use Utils;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function saveAmount(SaveAmountRequest $request) {
        $user = auth()->user();
        $user->amount = $request->amount;
        $user->save();

        return $this->returnDataJson($user);
    }
}
