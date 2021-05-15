<?php
if (!function_exists('convertDateTime')) {
    function convertDateTime($date, $timeZone = null)
    {
        $datetime = new DateTime($date);
        $la_time = new DateTimeZone($timeZone);
        $datetime->setTimezone($la_time);
        return $datetime->format('Y-m-d h:i A');
    }
}
