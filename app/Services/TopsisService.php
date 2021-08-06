<?php


namespace App\Services;


class TopsisService
{
    public $totalSummary = 0;

    public function power($number): int
    {
        return $number ** 2;
    }

    public function summary($number)
    {
        return $this->totalSummary += $number;
    }

    public function sqrt(): float
    {
        return sqrt($this->totalSummary);
    }

    public function normalizeValue($value)
    {
        return $value / $this->sqrt();
    }

    public function multiple($value, $weight)
    {
        return $value * $weight;
    }

    public function positiveIdeal($array)
    {
        asort($array);
        return end($array);
    }

    public function negativeIdeal($array)
    {
        asort($array);
        return $array[0];
    }

    public function distancePositiveIdeal($value, $maxValue): int
    {
        return ($value - $maxValue) ** 2;
    }

    public function distanceNegativeIdeal($value, $minValue): int
    {
        return ($value - $minValue) ** 2;
    }

    public function getClosedSolution($positiveValue, $negativeValue): string
    {
         return number_format($negativeValue / ($negativeValue + $positiveValue), 2);
    }
}
