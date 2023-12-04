<?php

namespace App\Services;

use App\Models\Zone;
use Carbon\Carbon;

final class ParkingPriceService
{
    public static function calculatePrice(
        int $zoneId,
        string $startTime,
        string $stopTime = null,
    ): int
    {
        $start = new Carbon($startTime);
        $stop = (!is_null($stopTime)) ? new Carbon($stopTime) : now();

        $totalTimeByMinutes = $stop->diffInMinutes($start);
        $priceByMinutes = Zone::query()
            ->find($zoneId)->price_per_hour / 60;

        return ceil($totalTimeByMinutes * $priceByMinutes);
    }
}
