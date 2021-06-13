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

}
