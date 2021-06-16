<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\ScienceField;
use Illuminate\Http\Request;

class ScienceFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scienceFields = ScienceField::ordered();
        $code = ScienceField::generateCode();
        return viewAcademicStaff('science-field.index', compact('scienceFields', 'code'));
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
        $this->validate($request, ['code' => 'required|unique:science_fields,code']);

        $scienceField = new ScienceField();
        $scienceField->code = $request->get('code');
        $scienceField->name = $request->get('name');

        if($scienceField->save()) {
            $message = setFlashMessage('success', 'insert', 'bidang ilmu');
        } else {
            $message = setFlashMessage('error', 'insert', 'bidang ilmu');
        }

        return redirect()->route('science-fields.index')->with('message', $message);
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
        $this->validate($request, ['code' => 'required|unique:science_fields,code,' . $id]);

        $scienceField = ScienceField::where('id', $id)->firstOrFail();
        $scienceField->code = $request->get('code');
        $scienceField->name = $request->get('name');

        if($scienceField->update()) {
            $message = setFlashMessage('success', 'update', 'bidang ilmu');
        } else {
            $message = setFlashMessage('error', 'update', 'bidang ilmu');
        }

        return redirect()->route('science-fields.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scienceField = ScienceField::where('id', $id)->firstOrFail();

        if($scienceField->delete()) {
            $message = setFlashMessage('success', 'delete', 'bidang ilmu');
        } else {
            $message = setFlashMessage('error', 'delete', 'bidang ilmu');
        }

        return redirect()->route('science-fields.index')->with('message', $message);
    }
}
