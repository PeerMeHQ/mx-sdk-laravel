<?php

namespace Peerme\Multiversx\Utils;

use Carbon\Carbon;

class Formatter
{
    public static function timeToHumanReadable(?Carbon $time): string
    {
        if ($time === null) {
            return null;
        }

        return now()->addMonths(6)->greaterThan($time)
            ? $time->shortRelativeToNowDiffForHumans()
            : $time->format('j F Y');
    }


    public static function numberToHumanReadableShort(int $num): string
    {
        // Taken from: https://stackoverflow.com/questions/4116499/php-count-round-thousand-to-a-k-style-count-like-facebook-share-twitter-bu/36365553
        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }

        return $num;
    }

    public static function trimHash(string $hash, int $keep = 10): string
    {
        $start = substr($hash, 0, $keep);
        $end = substr($hash, -$keep);

        return "{$start}...{$end}";
    }
}
