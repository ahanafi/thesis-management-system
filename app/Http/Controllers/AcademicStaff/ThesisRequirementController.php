<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\ThesisRequirement;
use Illuminate\Http\Request;

class ThesisRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thesisRequirements = ThesisRequirement::all();
        return viewAcademicStaff('thesis-requirement.index', compact('thesisRequirements'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
