<?php


namespace App\Constants;


use App\Models\User;

class GuidanceStatus
{
    const SENT = 'SENT';
    const REVIEW = 'REVIEW';
    const REPLIED = 'REPLIED';

    public static function showLabel($label, $textOnly = false)
    {
        $className = 'warning';
        $text = 'TERKIRIM';
        switch ($label) {
            case self::SENT:
                $className = 'warning';
                $text = 'TERKIRIM';
                break;
            case self::REVIEW:
                $className = 'info';
                $text = 'SEDANG DITINJAU';
                break;
            case self::REPLIED:
                $className = 'success';
                $text = 'TERJAWAB';
                break;
        }

        if($textOnly === true) {
            return $text;
        }

        if(auth()->user()->level !== User::STUDENT && $label === self::SENT) {
            $text = 'BELUM DITANGGAPI';
        }

        return "<label class='badge badge-$className'>$text</label>";
    }
}
