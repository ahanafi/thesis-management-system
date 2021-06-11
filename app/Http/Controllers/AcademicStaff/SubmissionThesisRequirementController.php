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

    public function submitResponse(Request $request, $id)
    {
        $this->validate($request, [
            'response_type' => 'required'
        ]);

        $submission = SubmissionThesisRequirement::findOrFail($id);
        $submission->status = strtoupper($request->get('response_type'));
        $submission->response_date = now();

        if($submission->save()) {
            $message = setFlashMessage('success', 'update', 'pengajuan persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'update', 'pengajuan persyaratan skripsi');
        }

        return redirect()->back()->with('message', $message);

    }
}
