<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function rate(RateRequest $request)
    {
        $validated = $request->validated();
        $value = DB::table('rates')->select('value')->where('date', $validated['date'])->first();
        if (is_null($value)) {
            $value['value'] = 0;
        }

        return json_encode($value);
    }
}
