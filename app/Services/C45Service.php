<?php


namespace App\Services;


class C45Service
{
    private static function calculateCriteria($total, $criteriaTotal)
    {
        $division = $criteriaTotal/$total;
        return (-$division) * log($division, 2);
    }

    public static function calculateEntropy($total, $firstCriteriaTotal, $secondCriteriaTotal)
    {
        $firstCriteria = self::calculateCriteria($total, $firstCriteriaTotal);
        $secondCriteria = self::calculateCriteria($total, $secondCriteriaTotal);
        $summary = $firstCriteria + $secondCriteria;
        if(!is_nan($summary)) {
            return number_format($summary, 5);
        }
        return 0;
    }

    private static function calculateEachEntropy($totalCases, $totalCriteria, $entropy)
    {
        return (($totalCriteria / $totalCases) * $entropy);
    }

    public static function calculateGain($entropyTotal, $totalCases, $attributtes = [])
    {
        $totalAllEntropy = 0;
        foreach ($attributtes as $attributte) {
            $totalCriteria = $attributte['total_criteria'];
            $entropy = $attributte['entropy_criteria'];

            $totalAllEntropy += self::calculateEachEntropy($totalCases, $totalCriteria, $entropy);
        }

        return number_format(($entropyTotal - $totalAllEntropy), 5);

    }

}
