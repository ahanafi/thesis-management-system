<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSet extends Model
{
    use HasFactory, Uuid;

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
}
