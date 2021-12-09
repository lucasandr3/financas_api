<?php

namespace App\Helpers;

class Helpers
{
    public static function formatMoney(float $value, int $precision = 2): string
    {
        return "R$ " . number_format($value, $precision, ',','.');
    }

    public static function formatDateSimple(string $date): string
    {
        return $date = date('d/m/Y', strtotime($date));
    }

    public static function formatInterest(float $value, int $precision = 1): string
    {
        return number_format($value, $precision, '.','.') . "%";
    }
}
