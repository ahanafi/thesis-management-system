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

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:science_fields,code',
            'name' => 'required|unique:science_fields,name',
        ]);

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
