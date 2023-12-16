<?php


if (!function_exists('getJalaliTime')) {
    function getJalaliTime($date, $format = "H:i:s - Y/m/d")
    {
        $jdate = new Verta($date);
        return $jdate->format($format);
    }
}

if (!function_exists('dateFormating')) {
    function dateFormating($value)
    {
        $value = substr($value, 0, 10);
        return date("Y-m-d H:i:s", (int) $value);
    }
}