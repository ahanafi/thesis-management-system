<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    public function data(Request $request)
    {
        $lecturers = Lecturer::with(['study_program'])->orderBy('full_name', 'ASC');

        //Filtering || Searching
        $search = $request->get('search');
        $lecturship = $request->get('filterLecturship');
        $homebase = $request->get('filterHomebase');


        if ($request->has('search') && $request->get('search')['value'] !== null) {
            $keyword = $search['value'];

            $lecturers->where('full_name', 'LIKE', $keyword . '%')
                ->orWhere('nidn', 'LIKE', $keyword . '%')
                ->orWhere('study_program_code', 'LIKE', $keyword . '%')
                ->orWhere('email', 'LIKE', $keyword . '%');
        }

        //Filter by homebase only
        if($request->has('filterHomebase') && $homebase !== 'all' && $lecturship === 'all') {
            $lecturers->orWhere('study_program_code', $homebase);
        }

        //Filter by lecturship only
        if($request->has('filterLecturship') && $lecturship !== 'all' && $homebase === 'all') {
            if(strtoupper($lecturship) === 'NON-JAB') {
                $lecturers->orWhereNull('functional');
            } else {
                $lecturers->orWhere('functional', $lecturship);
            }
        }

        //Filter by homebase and lecturship
        if($request->has('filterHomebase') && $request->has('filterLecturship') && $homebase !== 'all' && $lecturship !== 'all') {
            $lecturers->where('study_program_code', $homebase);

            if(strtoupper($lecturship) === 'NON-JAB') {
                $lecturers->whereNull('functional');
            } else {
                $lecturers->where('functional', $lecturship);
            }
        }



        $lecturers->get();

        return datatables()->of($lecturers)
            ->editColumn('full_name', function ($lecturer) {
                return "<a href='". route('lecturers.show', $lecturer->id)."'>".$lecturer->getNameWithDegree()."</a>";
            })
            ->editColumn('homebase', function ($lecturer) {
                return $lecturer->study_program->name;
            })
            ->editColumn('functional', function ($lecturer) {
                return $lecturer->getLecturship();
            })
            ->addColumn('action', function ($lecturer) {
                return "<div class='btn-group'>
                    <a href='" . route('lecturers.edit', $lecturer->id) . "' class='btn btn-primary btn-sm'>
                        <i class='fa fa-pencil-alt'></i>
                    </a>
                    <button type='button' class='btn btn-danger btn-sm'
                        onclick='confirmDelete(`academic-staff/master/lecturers`, `" . $lecturer->id . "`)'>
                        <i class='fa fa-fw fa-trash'></i>
                    </button>
                </div>";
            })
            ->rawColumns(['full_name', 'action'])
            ->toJson();
    }
}
