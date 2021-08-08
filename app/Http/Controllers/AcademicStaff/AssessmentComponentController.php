<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use Illuminate\Http\Request;

class AssessmentComponentController extends Controller
{
    public function index()
    {
        $assessmentComponents = AssessmentComponent::all();
        return viewAcademicStaff('assessment-component.index', compact('assessmentComponents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'assessment_type' => 'required',
            'weight' => 'required|gte:5'
        ]);

        $assessmentComponent = [
            'name' => $request->get('name'),
            'assessment_type' => $request->get('assessment_type'),
            'weight' => $request->get('weight')
        ];

        $createAssessmentComponent = AssessmentComponent::create($assessmentComponent);

        if($createAssessmentComponent) {
            $message = setFlashMessage('success', 'insert', 'komponen penilaian');
        } else {
            $message = setFlashMessage('error', 'insert', 'komponen penilaian');
        }

        return redirect()->route('assessment-components.index')->with('message', $message);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'assessment_type' => 'required',
            'weight' => 'required|gte:5'
        ]);

        $assessmentComponent = AssessmentComponent::where('id', $id)->firstOrFail();

        $updateAssessmentComponent = $assessmentComponent->update([
            'name' => $request->get('name'),
            'assessment_type' => $request->get('assessment_type'),
            'weight' => $request->get('weight')
        ]);

        if($updateAssessmentComponent) {
            $message = setFlashMessage('success', 'update', 'komponen penilaian');
        } else {
            $message = setFlashMessage('error', 'update', 'komponen penilaian');
        }

        return redirect()->route('assessment-components.index')->with('message', $message);
    }

    public function destroy($id)
    {
        $assessmentComponent = AssessmentComponent::where('id', $id)->firstOrFail();

        if($assessmentComponent->delete()) {
            $message = setFlashMessage('success', 'delete', 'komponen penilaian');
        } else {
            $message = setFlashMessage('error', 'delete', 'komponen penilaian');
        }

        return redirect()->route('assessment-components.index')->with('message', $message);
    }
}
