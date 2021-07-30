<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Services\Downloads\ThesisDocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $thesis = Thesis::studentId($nim)->with([
            'student', 'scienceField', 'firstSupervisor', 'secondSupervisor'
        ])->first();

        $user = auth()->user()->load('studentProfile');

        return viewStudent('thesis.index', compact('thesis', 'user'));
    }

    public function update(Request $request, Thesis $thesis)
    {
        $dataType = 'dokumen skripsi';

        if(strtolower($request->type) === 'report') {
            $this->validate($request, [
                'type' => 'required',
                'document' => 'required|mimes:pdf,doc,docx,zip,rar'
            ]);

            $report = $request->file('document')->store('documents/report');
            $thesis->document = $report;
            $dataType = 'dokumen skripsi';
        }

        if(strtolower($request->type) === 'app') {
            $this->validate($request, [
                'type' => 'required',
                'document' => 'mimes:pdf,doc,docx,zip,rar'
            ]);

            if($request->url !== '') {
                $thesis->application = $request->url;
            }

            if($request->hasFile('app') && $request->file('app') !== '') {
                $application = $request->file('app')->store('document/programs');
                $thesis->application = $application;
            }

            $dataType = 'program skripsi';
        }

        if(strtolower($request->type) === 'journal') {
            $this->validate($request, [
                'type' => 'required',
                'journal' => 'required|mimes:pdf,doc,docx'
            ]);

            $journal = $request->file('journal')->store('documents/journal');
            $thesis->journal = $journal;
            $dataType = 'jurnal skripsi';
        }

        if($thesis->update()) {
            $messages = setFlashMessage('success', 'upload', $dataType);
        } else {
            $messages = setFlashMessage('error', 'upload', $dataType);
        }

        return redirect()->back()->with('message', $messages);
    }

    public function download($documentType)
    {
        $nim = auth()->user()->registration_number;
        $thesis = Thesis::studentId($nim)->with(['student'])->firstOrFail();

        $download = new ThesisDocumentService($thesis);
        $download->setDocumentTyppe($documentType);
        return $download->download();
    }
}
