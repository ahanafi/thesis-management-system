<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $thesis = Thesis::getByStudentId($nim)->with([
            'student', 'scienceField', 'firstSupervisor', 'secondSupervisor'
        ])->first();

        return viewStudent('thesis.index', compact('thesis'));
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
        $thesis = Thesis::getByStudentId($nim)->with(['student'])->firstOrFail();

        // Report
        if($documentType === 'report' && $thesis->document !== null && Storage::exists($thesis->document)) {
            $splitFileName = explode('.', $thesis->document);
            $fileExtension = end($splitFileName);
            $fileName = "Laporan_Skripsi_" . $thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($thesis->document, $fileName);
        }

        // App
        if($documentType === 'app' && $thesis->application !== null && Storage::exists($thesis->application)) {
            $splitFileName = explode('.', $thesis->application);
            $fileExtension = end($splitFileName);
            $fileName = "Laporan_Skripsi_" . $thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($thesis->application, $fileName);
        }

        // Journal
        if($documentType === 'journal' && $thesis->journal !== null && Storage::exists($thesis->journal)) {
            $splitFileName = explode('.', $thesis->journal);
            $fileExtension = end($splitFileName);
            $fileName = "Laporan_Skripsi_" . $thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($thesis->journal, $fileName);
        }
    }
}
