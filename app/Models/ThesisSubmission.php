<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisSubmission extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim')
            ->with('study_program');
    }

    public function scienceField()
    {
        return $this->hasOne(ScienceField::class, 'id', 'science_field_id');
    }
}
