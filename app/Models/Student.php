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

    public function submission_thesis_requirement()
    {
        return $this->hasOne(SubmissionThesisRequirement::class, 'nim', 'nim')->with('details');
    }
}
