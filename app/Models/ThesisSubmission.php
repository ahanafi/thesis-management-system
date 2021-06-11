<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisSubmission extends Model
{
    use HasFactory, Uuid;

    protected $table = 'thesis_submission';
    public $incrementing = false;
}
