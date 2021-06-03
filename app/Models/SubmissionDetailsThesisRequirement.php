<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDetailsThesisRequirement extends Model
{
    use HasFactory, Uuid;
    protected $table = 'submission_details_thesis_requirements';

    protected $fillable = [
        'submission_id', 'thesis_requirement_id', 'documents'
    ];
}
