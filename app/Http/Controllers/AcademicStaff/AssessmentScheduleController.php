<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class AssessmentScheduleController extends Controller
{
    public function index()
    {
        return viewAcademicStaff('schedules.index');
    }

     public function create()
    {
        $submissions = SubmissionAssessment::approved()->get();

        return viewAcademicStaff('schedules.create', compact('submissions'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
