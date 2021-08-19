<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTesting extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'full_name',
        'homebase',
        'functional',
        'count_as_first_examiner',
        'count_as_second_examiner',
        'label_as_first_examiner',
        'label_as_second_examiner',
        'quota',
        'examiner_type',
        'search_order',
    ];
}
