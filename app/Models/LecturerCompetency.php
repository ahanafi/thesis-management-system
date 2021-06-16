<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerCompetency extends Model
{
    protected $table = 'lecturer_competency';
    use HasFactory, Uuid;
    public $incrementing = false;
    public $timestamps = false;
}
