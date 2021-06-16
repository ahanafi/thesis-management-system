<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\LecturerCompetency;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CompetencyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, ['competencies' => 'required']);
        $competencies = $request->get('competencies');
        $lecturerId = $request->get('lecturer_id');

        $lecturer = Lecturer::where('id', $lecturerId)->first();

        //Delete first
        LecturerCompetency::where('lecturer_id', $lecturerId)
            ->whereNotIn('science_field_id', $competencies)
            ->delete();

        $lecturer->competencies()->syncWithoutDetaching($competencies);

        $message = setFlashMessage('success', 'update', 'kompetensi dosen');

        return redirect()->route('lecturer.profile')->with('message', $message);
    }
}
