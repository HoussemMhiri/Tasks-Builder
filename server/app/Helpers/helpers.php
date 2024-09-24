<?php

if (!function_exists('toSimpleHumanDate')) {
    function toSimpleHumanDate($date, $with_time = false)
    {
        $format = 'D MMMM YYYY';
        if ($with_time) {
            $format .= ' HH:mm';
        }
        return $date->isoFormat($format);
    }
}
