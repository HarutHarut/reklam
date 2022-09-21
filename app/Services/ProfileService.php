<?php

namespace App\Services;

use Carbon\Carbon;

/**
 * Class ProfileService
 * @package App\Services
 */
class ProfileService
{
    /**
     * @param $user
     * @return mixed
     */
    public static function statistics($user){
        $statistics = [];
        if (isset($user->customer) && $user->customer !== null){
            $statistics['activeOglasiCount'] = $user->customer->maliOglases()->where('status', 1)->count();
            $statistics['allViews'] = $user->customer->maliOglases()->sum('views_count');
            $statistics['days'] = self::freeListing($user->customer->maliOglases()->where('status', 1)->get());
        }

        return $statistics;
    }

    /**
     * @param $listings
     * @return float|int
     */
    public static function freeListing($listings)
    {
        $listingsCount = count($listings);
        $now = Carbon::now()->format('Y-m-d');
        $days = 100;
        $daysArr = [];
        foreach ($listings as $listing){
            $date = date('Y-m-d', strtotime($listing->datum_vnosa));
            $arrCountDays = round(count_days(strtotime($now), strtotime($date)) / (60 * 60 * 24));
            if($arrCountDays >= 0){
                $daysArr[] = round(count_days(strtotime($now), strtotime($date)) / (60 * 60 * 24));
            }
        }

        return total_days($listingsCount, array_sum($daysArr), $days);
    }
}
