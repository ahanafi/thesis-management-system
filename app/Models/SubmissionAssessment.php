<?php

namespace App\Models;

use App\Constants\AssessmentTypes;
use App\Constants\Status;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentSchedule;

class SubmissionAssessment extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $table = 'submission_of_assessments';
    protected $keyType = 'string';

    public function thesis()
    {
        return $this->belongsTo(Thesis::class)
            ->with('student');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim')->with(['study_program', 'user']);
    }

    public function schedule()
    {
        return $this->hasOne(AssessmentSchedule::class, 'submission_assessment_id');
    }

    public function firstExaminer()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'first_examiner');
    }

    public function secondExaminer()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'second_examiner');
    }

    public function scores()
    {
        return $this->hasMany(AssessmentScore::class, 'submission_assessment_id', 'id')
            ->with(['components']);
    }

    public function scopeStudyProgramOfStudent($query, $studyProgramId)
    {
        return $query->whereHas('student', function ($q) use ($studyProgramId) {
            $q->where('study_program_code', $studyProgramId);
        });
    }

    public function scopeType($query, $type)
    {
        if($type === 'final-test') {
            $type = AssessmentTypes::TRIAL;
        }
        return $query->where('assessment_type', $type);
    }

    public function scopeEmptyTester($query)
    {
        return $query->whereNull('first_examiner')
            ->whereNull('second_examiner');
    }

    public function scopeAlreadyTesters($query)
    {
        return $query->whereNotNull('first_examiner')
            ->whereNotNull('second_examiner');
    }

    public function scopeApproved($query)
    {
        return $query->where('status_first_supervisor', Status::APPROVE)
            ->where('status_second_supervisor', Status::APPROVE);
    }

    public function scopeStudentId($query, $studentId)
    {
        return $query->where('nim', $studentId);
    }

    public function isApplied()
    {
        return $this->status_first_supervisor === Status::APPLY && $this->status_second_supervisor === Status::APPLY;
    }

    public function isApproved()
    {
        return $this->status_first_supervisor === Status::APPROVE && $this->status_second_supervisor === Status::APPROVE;
    }
}
