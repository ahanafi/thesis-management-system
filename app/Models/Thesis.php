<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim', 'research_title', 'science_field_id', 'document',
        'application', 'journal', 'first_guide', 'second_guide'
    ];

    public static function scopeStudentId($query, $nim)
    {
        return $query->where('nim', $nim);
    }

    public static function getDoesNotHaveSupervisor(string $studyProgramCode)
    {
        return self::with(['student', 'scienceField'])
            ->whereHas('student', function ($q) use ($studyProgramCode) {
                return $q->where('study_program_code', $studyProgramCode);
            })
            ->where(function($q){
                return $q->whereNull('first_supervisor')
                ->orWhereNull('second_supervisor');
            })
            ->get();
    }

    public static function getSupervisorOnly($studentId)
    {
        return self::query()
            ->select('first_supervisor', 'second_supervisor', 'id')
            ->where('nim', $studentId)
            ->first();
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim')->with(['study_program', 'user']);
    }

    public function scienceField()
    {
        return $this->hasOne(ScienceField::class, 'id', 'science_field_id');
    }

    public function firstSupervisor()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'first_supervisor');
    }

    public function secondSupervisor()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'second_supervisor');
    }

    public function assessmentSubmission()
    {
        return $this->hasMany(SubmissionAssessment::class, 'thesis_id', 'id');
    }
}
