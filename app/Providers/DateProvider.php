<?php

namespace App\Providers;

use App\Interfaces\DateProviderInterface;
use Carbon\Carbon;

class DateProvider implements DateProviderInterface
{
    public function getDate($formattedDate)
    {
        return Carbon::parse($formattedDate);
    }

    public function addDays($days)
    {
        return Carbon::now()->addDays($days);
    }

    public function addMinutes($minutes)
    {
        return Carbon::now()->addMinutes($minutes);
    }

    public function isValidDate($date)
    {
        $currentDate = Carbon::now();
        $providedDate = Carbon::parse($date);

        return $providedDate->isAfter($currentDate);
    }
}

?>
