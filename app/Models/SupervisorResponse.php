<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorResponse extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['guidance_id', 'response', 'document'];

    public function guidance()
    {
        return $this->belongsTo(Guidance::class,  'guidance_id', 'id')
            ->with(['student', 'thesis']);
    }
}
