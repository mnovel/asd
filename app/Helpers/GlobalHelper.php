<?php

namespace App\Helpers;

use App\Models\Setting;
use Carbon\Carbon;

class GlobalHelper
{
    public static function extractOpenTime($time)
    {
        $timeRange = explode(' - ', $time);
        return Carbon::createFromFormat('m/d/Y h:i A', $timeRange[0]);
    }

    public static function extractCloseTime($time)
    {
        $timeRange = explode(' - ', $time);
        return Carbon::createFromFormat('m/d/Y h:i A', $timeRange[1]);
    }

    public static function setting($name)
    {
        $setting =  Setting::first()->value($name);
        return  $setting;
    }
}
