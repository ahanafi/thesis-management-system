<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class CompetencyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, ['competencies' => 'required']);
        $competencies = $request->get('competencies');
        $lecturerId = $request->get('lecturer_id');

        $lecturer = Lecturer::where('id', $lecturerId)->first();

        $lecturer->competencies()->sync($competencies);

        $message = setFlashMessage('success', 'update', 'kompetensi dosen');

        return redirect()->route('lecturer.profile')->with('message', $message);
    }
}
