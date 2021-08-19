<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSet extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'student_name',
        'study_program_name',
        'thesis_year',
        'research_title',
        'science_field_name',
        'first_supervisor',
        'second_supervisor',
        'first_seminar_examiner',
        'second_seminar_examiner',
        'first_trial_examiner',
        'second_trial_examiner',
    ];

    public function scopeCheckHaveTestedInRelatedStudyProgram($query, $studyProgramName, $lecturerName): bool
    {
        return (bool)$query->where(function ($q) use ($lecturerName) {
            $q->where('first_trial_examiner', 'LIKE', '%' . $lecturerName . '%')
                ->orWhere('second_trial_examiner', 'LIKE', '%' . $lecturerName . '%');
        })
            ->where('study_program_name', $studyProgramName)
            ->count();
    }

    public function scopeCountAsFirstExaminer($query, $lecturerName)
    {
        return $query->where('first_trial_examiner', 'LIKE', '%' . $lecturerName . '%')->count();
    }

    public function scopeCountAsSecondExaminer($query, $lecturerName)
    {
        return $query->where('second_trial_examiner', 'LIKE', '%' . $lecturerName . '%')->count();
    }
}
