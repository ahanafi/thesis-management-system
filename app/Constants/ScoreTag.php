<?php

namespace App\Constants;

class ScoreTag
{
    public static $label;

    public static function getFirstLabel($value)
    {
        if ($value >= 14) {
            self::$label = 'SANGAT TINGGI';
        } elseif ($value >= 8 && $value <= 13) {
            self::$label = 'TINGGI';
        } elseif ($value >= 4 && $value <= 7) {
            self::$label = 'CUKUP';
        } else {
            self::$label = 'KURANG';
        }

        return self::$label;
    }

    public static function getSecondLabel($value)
    {
        if ($value >= 12) {
            self::$label = 'SANGAT TINGGI';
        } elseif ($value >= 8 && $value <= 11) {
            self::$label = 'TINGGI';
        } elseif ($value >= 4 && $value <= 7) {
            self::$label = 'CUKUP';
        } else {
            self::$label = 'KURANG';
        }

        return self::$label;
    }
}
