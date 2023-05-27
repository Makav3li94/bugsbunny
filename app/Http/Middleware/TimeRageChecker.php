<?php

namespace App\Http\Middleware;

use App\Models\CustomerManagement;
use App\Models\Setting;
use Carbon\Carbon;
use Closure;
use Morilog\Jalali\CalendarUtils;
use function App\Helpers\numberConverter;

class TimeRageChecker
{

    public function handle($request, Closure $next)
    {
        if (count(Setting::all()) > 0 && Setting::all()->first()->time_range != null) {
            $range = intval(Setting::all()->first()->time_range);
        } else {
            $range = intval(20);
        }
       // $id = $request->segment(4);
        $all = $request->all();
        if ($all['date'] != null && $all['time'] != null) {
            $persianDate = numberConverter($all['date']);
            $carbonDate = CalendarUtils::createCarbonFromFormat('Y/m/d', $persianDate)->format('Y-m-d');
            $persianTime = numberConverter($all['time']);
            $persianString = $persianDate . ' ' . $persianTime;
            $finalCarbonDate = Carbon::parse(CalendarUtils::createCarbonFromFormat('Y/m/d H:i',
                $persianString)->toDateTimeString());
            $cmts = CustomerManagement::where([['status', '0']])
                ->whereNotNull('reminder_date')
                ->whereDate('reminder_date', $carbonDate)
                ->get();
            if (count($cmts) > 0) {
                $i = 0;
                foreach ($cmts as $cmt) {
                    $persianCmtTime = numberConverter($cmt->reminder_time);
                    $finalCarbonCmtString = $cmt->reminder_date . ' ' . $persianCmtTime;
                    $finalCarbonCmtDate = Carbon::parse(Carbon::createFromFormat('Y-m-d H:i',
                        $finalCarbonCmtString));
                    $lowerRange = $finalCarbonCmtDate->subMinutes($range)->toDateTimeString();
                    $upperRange = $finalCarbonCmtDate->addMinutes(2 * $range)->toDateTimeString();
                    if ($finalCarbonDate->gte($lowerRange) && $finalCarbonDate->lte($upperRange)) {
                        $i++;
                    }
                }
                if ($i > 0) {
                    return response()->json(['time' => 'overlapped']);
                } else {
                    return $next($request);
                }
            } else {
                return $next($request);
            }

        } else {
            return $next($request);
        }
    }
}
