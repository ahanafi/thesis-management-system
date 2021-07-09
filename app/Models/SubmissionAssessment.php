<?php

namespace App\Models;

use App\AssessmentTypes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionAssessment extends Model
{
    use HasFactory, Uuid;
    protected $table = 'submission_of_assessments';

    public function scopeType($query, $type)
    {
        return $query->where('assessment_type', $type);
    }
}
