<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;

class RateController extends Controller
{
    public function rate(RateRequest $request)
    {
        $validated = $request->validated();
        $value = 22.567;

        return json_encode($value);
    }
}
