<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\SubmissionThesisRequirement;
use App\Models\ThesisRequirement;
use Illuminate\Http\Request;

class ThesisRequirementController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('status')) {
            if($request->get('status') === 'unresponse' || $request->get('status') === 'approve' || $request->get('status') === 'reject') {
                $status = $request->get('status') === 'unresponse' ? Status::APPLY : $request->get('status');
            } else {
                abort(404);
            }
        } else {
            $status = Status::APPLY;
        }

        $thesisRequirements = ThesisRequirement::all();
        $submissionThesisRequirements = SubmissionThesisRequirement::with(['student', 'details'])
            ->status([$status])
            ->orderByDesc('date_of_filling')
            ->get();

        return viewAcademicStaff('thesis-requirement.index', compact('thesisRequirements', 'submissionThesisRequirements', 'status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'document_name' => 'required',
            'document_type' => 'required'
        ]);

        $isRequired = $request->has('is-required') ? 1 : 0;

        $thesisRequirement = [
            'document_name' => $request->get('document_name'),
            'document_type' => $request->get('document_type'),
            'note' => $request->get('note'),
            'is_required' => $isRequired
        ];

        $createThesisRequirement = ThesisRequirement::create($thesisRequirement);

        if($createThesisRequirement){
            $message = setFlashMessage('success', 'insert', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'insert', 'persyaratan skripsi');
        }

        return redirect()->route('thesis-requirements.index')->with('message', $message);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'document_name' => 'required',
            'document_type' => 'required'
        ]);

        $isRequired = $request->has('is-required') ? 1 : 0;

        $thesisRequirement = [
            'document_name' => $request->get('document_name'),
            'document_type' => $request->get('document_type'),
            'note' => $request->get('note'),
            'is_required' => $isRequired
        ];

        $updateThesisRequirement = ThesisRequirement::where('id', $id)->update($thesisRequirement);

        if($updateThesisRequirement){
            $message = setFlashMessage('success', 'update', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'update', 'persyaratan skripsi');
        }

        return redirect()->route('thesis-requirements.index')->with('message', $message);
    }

    public function destroy($id)
    {
        $thesisRequirement = ThesisRequirement::where('id', $id)->firstOrFail();
        if($thesisRequirement->delete()) {
            $message = setFlashMessage('success', 'delete', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'delete', 'persyaratan skripsi');
        }

        return redirect()->route('thesis-requirements.index')->with('message', $message);
    }
}
