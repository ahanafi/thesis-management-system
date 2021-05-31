<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'id', 'faculty_code', 'faculty_name', 'dean_code'
    ];

    public $incrementing = false;
}
