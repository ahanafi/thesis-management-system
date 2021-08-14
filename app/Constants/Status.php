<?php


namespace App\Constants;


class Status
{
    const DRAFT = 'DRAFT';
    const APPLY = 'APPLY';
    const WAITING = 'WAITING';
    const APPROVE = 'APPROVE';
    const REJECT = 'REJECT';
    const REVISION = 'REVISION';

    public static function getLabel($status, $textOnly = false): string
    {
        $labelText = '';
        $labelType = '';
        if($status === self::DRAFT) {
            $labelText = self::DRAFT;
            $labelType = 'info';
        } else if($status === self::APPLY || $status === self::WAITING) {
            $labelText = 'DIAJUKAN';
            $labelType = 'primary';
        } else if($status === self::APPROVE) {
            $labelText = 'DITERIMA';
            $labelType = 'success';
        } else if($status === self::REJECT) {
            $labelText = 'DITOLAK';
            $labelType = 'danger';
        } else if($status === self::REVISION) {
            $labelText = 'REVISI';
            $labelType = 'warning';
        }

        if($textOnly) {
            return $labelText;
        }

        return "<span class='badge badge-$labelType'>$labelText</span>";
    }
}
