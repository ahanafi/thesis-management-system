<?php

namespace App\Models;

use App\AssessmentTypes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionAssessment extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $table = 'submission_of_assessments';

    public function thesis()
    {
        return $this->belongsTo(Thesis::class, 'thesis_id', 'id')->with('student');
    }

    public function schedule()
    {
        return $this->hasOne(AssessmentSchedule::class, 'submission_assessment_id', 'id');
    }

    public function firstExaminer()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'first_examiner');
    }

    public function secondExaminer()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'second_examiner');
    }

    public function scopeType($query, $type)
    {
        return $query->where('assessment_type', $type);
    }

    public function scopeStudentId($query, $studentId)
    {
        return $query->where('nim', $studentId);
    }
}
