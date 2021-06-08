<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'nim', 'full_name', 'study_program_code', 'gender',
        'place_of_birth', 'date_of_birth', 'address',
        'phone', 'email', 'picture', 'semester'
    ];

    public function getName()
    {
        $names = explode(" ", ucwords(strtolower($this->full_name)));

        if(count($names) <= 2) {
            return ucwords(strtolower($this->full_name));
        } else {
            $firstName = $names[0] . " " . $names[1];
            foreach($names as $key => $val) {
                if($key >= 2) {
                    $lastName .= $val[0];
                }
            }

            return $firstName . " " . $lastName;
        }
    }

    public function study_program()
    {
        return $this->hasOne(StudyProgram::class, 'study_program_code', 'study_program_code');
    }

    public function submission_thesis_requirements()
    {
        return $this->hasOne(SubmissionThesisRequirement::class, 'nim', 'nim')->with('details');
    }
}
