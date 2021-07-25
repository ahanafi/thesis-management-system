<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'nidn',
        'full_name',
        'email',
        'gender',
        'study_program_code',
        'functional',
        'degree'
    ];

    public function getNameWithDegree()
    {
        return showName($this->full_name, $this->degree);
    }

    public function getShortName()
    {
        $names = explode(" ", ucwords(strtolower($this->full_name)));

        if (count($names) <= 2) {
            return ucwords(strtolower($this->full_name));
        } else {
            $firstName = $names[0] . " " . $names[1];
            $lastName = "";
            foreach ($names as $key => $val) {
                if ($key >= 2 && !empty($val)) {
                    $lastName .= $val[0];
                }

                if ($key < count($names) - 4) {
                    $lastName .= ".";
                }
            }

            return $firstName . " " . $lastName;
        }
    }

    public function getFullName()
    {
        return ucwords(strtolower($this->full_name));
    }

    public function hasCompetency(): bool
    {
        return $this->competencies() ? true : false;
    }

    public function competencies()
    {
        return $this->belongsToMany(ScienceField::class, 'lecturer_competency');
    }

    public function study_program()
    {
        return $this->hasOne(StudyProgram::class, 'study_program_code', 'study_program_code');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'registration_number', 'nidn');
    }

    public function scopeStudyProgramCode($query, $code)
    {
        return $query->where('study_program_code', $code);
    }
}
