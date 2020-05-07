<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function rate(RateRequest $request)
    {
        $validated = $request->validated();
        $date = new Carbon($validated['date']);
        if (Carbon::SATURDAY == $date->dayOfWeek || Carbon::SUNDAY == $date->dayOfWeek) {
            $date = $date->previousWeekday();
        }
        $value = DB::table('rates')->select('value')->where('date', $date)->first();
        if (is_null($value)) {
            $value['value'] = 0;
        }

        return json_encode($value);
    }
}
