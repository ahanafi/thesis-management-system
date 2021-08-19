<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisSubmission extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'research_title',
        'science_field_id',
        'status',
        'document',
        'date_of_filling',
        'response_date',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim')
            ->with('study_program');
    }

    public function scienceField()
    {
        return $this->hasOne(ScienceField::class, 'id', 'science_field_id');
    }

    public static function getByStudentId($nim)
    {
        return self::where('nim', $nim)
            ->latest()
            ->get();
    }

    public static function getLatestByStudentId($nim)
    {
        return self::where('nim', $nim)
            ->latest()
            ->first();
    }
}
