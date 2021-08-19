<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentSchedule extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'date',
        'start_at',
        'finished_at',
        'room_number',
        'submission_assessment_id'
    ];

    public function submission()
    {
        return $this->hasOne(SubmissionAssessment::class, 'id', 'submission_assessment_id')
            ->with(['thesis', 'firstExaminer', 'secondExaminer']);
    }

    public static function getBySubmissionId($submissionId)
    {
        return self::where('submission_assessment_id', $submissionId)
            ->first();
    }

    public function getAssessmentTime()
    {
        $startTime = date('H:i', strtotime($this->start_at));
        $finishTime = date('H:i', strtotime($this->finished_at));
        return $startTime . " - " . $finishTime;
    }

    public function setIsDone(bool $isDone)
    {
        return $this->update(['is_done' => $isDone]);
    }
}
