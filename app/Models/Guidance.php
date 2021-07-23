<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guidance extends Model
{
    use HasFactory, Uuid;

    protected $table = 'guidance';
    public $incrementing = false;

    protected $fillable = [
        'thesis_id',
        'nim',
        'title',
        'note',
        'document',
        'nidn',
        'guide_response',
        'guide_document',
        'guide_response_date',
        'guidance_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim')->with(['study_program', 'user']);
    }

    public function thesis()
    {
        return $this->hasOne(Thesis::class, 'id','thesis_id');
    }

    public static function getByStudentId($nim, $lecturerId)
    {
        return self::where('nim', $nim)
            ->where('nidn', $lecturerId)
            ->latest()
            ->get();
    }

}
