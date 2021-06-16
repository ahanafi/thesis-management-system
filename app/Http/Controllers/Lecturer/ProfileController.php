<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\LecturerCompetency;
use App\Models\ScienceField;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;
        $lecturer = Lecturer::with(['user', 'competencies','study_program'])
            ->where('nidn', $nidn)
            ->first();

        $scienceFields = ScienceField::ordered()->each(function ($field) use ($lecturer) {
            $field->isSelected = (bool) $lecturer->competencies()->where('science_field_id', $field->id)->count();
        });

        return viewLecturer('profile', compact('lecturer', 'scienceFields'));
    }
}
