<?php


namespace App\Constants;


use phpDocumentor\Reflection\Types\Self_;

class AssessmentTypes
{
    const SEMINAR = 'SEMINAR';
    const TRIAL = 'TRIAL';
    const COLLOQUIUM = 'COLLOQUIUM';

    public static function getLabel($type, $textOnly = false)
    {
        $className = '';

        if (strtoupper($type) === self::SEMINAR) {
            $className = 'warning';
        } else if (in_array(strtoupper($type), [self::TRIAL, 'FINAL-TEST'], true)) {
            $className = 'info';
        } else if (strtoupper($type) === self::COLLOQUIUM) {
            $className = 'success';
        }


        $text = getTypeOfAssessment(strtoupper($type));
        if (is_array($text)) {
            $text = self::SEMINAR;
        }

        if($textOnly) {
            return $text;
        }

        return "<label class='badge badge-$className font-size-h6 mt-1 text-uppercase'>$text</label>";
    }
}
