<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim', 'full_name', 'study_program_code', 'gender',
        'place_of_birth', 'date_of_birth', 'address',
        'phone', 'email', 'picture', 'semester'
    ];

    public function getName()
    {
        return showName($this->full_name);
    }

    public function scopeStudyProgramCode($query, $code)
    {
        return $query->where('study_program_code', $code);
    }

    /* Relationship */
    public function thesis()
    {
        return $this->hasOne(Thesis::class, 'nim', 'nim')
            ->with(['scienceField', 'firstSupervisor', 'secondSupervisor']);
    }

    public function study_program()
    {
        return $this->hasOne(StudyProgram::class, 'study_program_code', 'study_program_code');
    }

    public function submission_thesis_requirements()
    {
        return $this->hasOne(SubmissionThesisRequirement::class, 'nim', 'nim')->with('details');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'registration_number', 'nim');
    }

}
