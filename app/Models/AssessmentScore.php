<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

    public function submission()
    {
        return $this->belongsTo(SubmissionAssessment::class, 'submission_assessment_id', 'id');
    }

    public function components()
    {
        return $this->belongsTo(AssessmentComponent::class, 'assessment_component_id', 'id');
    }
}
