<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentComponent extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'name', 'assessment_type', 'weight'
    ];

    public $timestamps = false;
}
