<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\SubmissionThesisRequirement;
use Illuminate\Http\Request;

class SubmissionThesisRequirementController extends Controller
{
    public function show($id)
    {
        $submission = SubmissionThesisRequirement::with('student', 'details')->findOrFail($id);
        return viewAcademicStaff('thesis-requirement.submission', compact('submission'));
    }
}
