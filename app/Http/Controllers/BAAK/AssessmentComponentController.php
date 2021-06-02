<?php

namespace App\Http\Controllers\BAAK;

use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use Illuminate\Http\Request;

class AssessmentComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessmentComponents = AssessmentComponent::all();
        return view('assessment-component.index', compact('assessmentComponents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'assessment_type' => 'required',
            'weight' => 'required'
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

        return redirect()->route('assessment-component.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'assessment_type' => 'required',
            'weight' => 'required'
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

        return redirect()->route('assessment-component.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assessmentComponent = AssessmentComponent::where('id', $id)->firstOrFail();

        if($assessmentComponent->delete()) {
            $message = setFlashMessage('success', 'delete', 'komponen penilaian');
        } else {
            $message = setFlashMessage('error', 'delete', 'komponen penilaian');
        }

        return redirect()->route('assessment-component.index')->with('message', $message);
    }
}
