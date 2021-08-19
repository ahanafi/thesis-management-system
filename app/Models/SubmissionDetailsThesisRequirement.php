<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDetailsThesisRequirement extends Model
{
    use HasFactory, Uuid;
    protected $table = 'submission_details_thesis_requirements';
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'submission_id', 'thesis_requirement_id', 'document'
    ];

    public function thesis_requirement()
    {
        return $this->belongsTo(ThesisRequirement::class);
    }
}
