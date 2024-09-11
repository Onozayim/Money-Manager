<?php
namespace App\Traits;

use Carbon\Carbon;

trait DateUtils
{
    public function getActualPeriod()
    {
        return Carbon::now()->year . '-' . Carbon::now()->month;
    }
}