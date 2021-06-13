<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theses extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;

    protected $fillable = [
        'nim', 'research_title', 'science_field_id', 'document',
        'application', 'journal', 'first_guide', 'second_guide'
    ];

    public static function getByStudentId($nim)
    {
        return self::where('nim', $nim);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim')->with(['study_program', 'user']);
    }

    public function scienceField()
    {
        return $this->hasOne(ScienceField::class, 'id', 'science_field_id');
    }
}
