<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ThesisRequirement;
use Illuminate\Http\Request;

class ThesisRequirementController extends Controller
{
    public function index()
    {
        $thesisRequirements = ThesisRequirement::all();
        return viewStudent('thesis-requirement.index', compact('thesisRequirements'));
    }
}
