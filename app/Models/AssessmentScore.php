<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentScore extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'submission_assessment_id',
        'assessment_component_id',
        'nidn',
        'score',
    ];
}
