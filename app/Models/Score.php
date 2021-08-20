<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';

    protected $fillable = [
        'thesis_id',
        'nim',
        'seminar',
        'colloquium',
        'trial',
        'final_score',
        'predicate_value',
    ];

    public function scopeStudentId($query, $nim)
    {
        return $query->where('nim', $nim);
    }

    public function scopeThesis($query, $thesisId)
    {
        return $query->where('thesis_id', $thesisId);
    }
}
