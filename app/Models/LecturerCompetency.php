<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class LecturerCompetency extends Model
{
    use HasFactory;
    protected $table = 'lecturer_competency';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['lecturer_id', 'science_field_id'];

    public function scienceField()
    {
        return $this->belongsTo(ScienceField::class, 'science_field_id', 'id');
    }

    public function scopeLecturerId($query, $lecturerId)
    {
        return $query->where('lecturer_id', $lecturerId);
    }
}
