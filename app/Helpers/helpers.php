<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

/**
 * @param $timestamp
 * @param $utc
 * @return int
 */
function max_price ($result)
{
    $result = $result->get();
    return (int) $result->max('cena');
}

/**
 * @return false|string[]
 */
function get_cookie ()
{
    $favorites = request()->cookie('favorites') ?? null;
    return explode(',', $favorites);
}

/**
 * @param bool $trim
 * @return string
 */
function guid($trim = true) {
    // Windows
    if(function_exists('com_create_guid') === true) {
        if($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if(function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    mt_srand((double) microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace .
        substr($charid, 0, 8) . $hyphen .
        substr($charid, 8, 4) . $hyphen .
        substr($charid, 12, 4) . $hyphen .
        substr($charid, 16, 4) . $hyphen .
        substr($charid, 20, 12) .
        $rbrace;
    return $guidv4;
}

/**
 * @param null $end
 * @param null $start
 * @return null
 */
function count_days($end = null, $start = null)
{
    return $end - $start;
}

/**
 * @param $listingsCount
 * @param $daysArr
 * @param $days
 * @return float|int
 */
function total_days($listingsCount, $daysArr, $days)
{
    if($listingsCount * $daysArr <= $days){
        $days = $listingsCount * $daysArr;
    }
    return $days;
}
