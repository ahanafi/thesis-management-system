<?php


namespace App\Services;


class C45Service
{
    private static function calculateCriteria($total, $criteriaTotal)
    {
        if($total > 0) {
            $division = $criteriaTotal / $total;
            return (-$division) * log($division, 2);
        }
        return 0;
    }

    public static function calculateEntropy($total, $firstCriteriaTotal, $secondCriteriaTotal)
    {
        $firstCriteria = self::calculateCriteria($total, $firstCriteriaTotal);
        $secondCriteria = self::calculateCriteria($total, $secondCriteriaTotal);
        $summary = $firstCriteria + $secondCriteria;
        if (!is_nan($summary)) {
            return number_format($summary, 5);
        }
        return number_format(0, 5);
    }

    private static function calculateEachEntropy($totalCases, $totalCriteria, $entropy)
    {
        return (($totalCriteria) / ($totalCases) * $entropy);
    }

    public static function calculateGain($entropyTotal, $totalCases, $attributes = [])
    {
        $totalAllEntropy = 0;
        $index = 0;
        foreach ($attributes as $attributte) {
            $totalCriteria = $attributte['total_criteria'];
            $entropy = $attributte['entropy_criteria'];

            if($index === 0) {
                $totalAllEntropy = self::calculateEachEntropy($totalCases, $totalCriteria, $entropy);
            } else {
                $totalAllEntropy -= self::calculateEachEntropy($totalCases, $totalCriteria, $entropy);
            }
            $index++;
        }

        return number_format(($entropyTotal - ($totalAllEntropy)), 5);
    }

    public static function showLabel()
    {

    }
}
