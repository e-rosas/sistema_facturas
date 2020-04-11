<?php

namespace App\Actions;

use App\DiscountPersonData;
use App\PersonStats;
use Carbon\Carbon;

class CheckDiscountStatus
{
    public function verifyStatus()
    {
        $today = Carbon::today();
        $discounts = DiscountPersonData::where([['active', 1], ['end_date', '<=', $today]])
            ->get()
        ;
        foreach ($discounts as $discount) {
            $discount->expired();
            $person_stats = PersonStats::find($discount->person_data_id);
            $person_stats->status = 0;
            $person_stats->save();
            $discount->save();
        }
    }
}
