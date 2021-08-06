<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Root extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'index_root',
        'attribute',
        'sub_attribute',
        'total_cases',
        'total_first_examiner',
        'total_second_examiner',
        'entropy',
        'gain',
    ];
}
