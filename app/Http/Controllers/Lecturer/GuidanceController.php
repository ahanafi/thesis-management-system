<?php

namespace App\Http\Controllers\Lecturer;

use App\Constants\GuidanceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitSupervisorResponseRequest;
use App\Models\Guidance;
use App\Models\SupervisorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuidanceController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;
        $guidance = Guidance::where('nidn', $nidn)
            ->orderByDesc('created_at')
            ->get();

        return viewLecturer('guidance.index', compact('guidance'));
    }

    public function show(Guidance $guidance)
    {
        $guidance->load(['student', 'thesis', 'response']);

        if($guidance->status === GuidanceStatus::SENT) {
            $guidance->setStatus(GuidanceStatus::REVIEW);
        }

        return viewLecturer('guidance.single', compact('guidance'));
    }

    public function download(Guidance $guidance)
    {
        $guidance->load(['student']);

        if($guidance->document !== null && Storage::exists($guidance->document)) {
            $splitFileName = explode('.', $guidance->document);
            $fileExtension = end($splitFileName);
            $guidanceDate = $guidance->created_at->format('d_m_Y');
            $fileName = "Bimbingan_Skripsi_" . $guidance->student->getName() .'_'. $guidanceDate . '.' . $fileExtension;

            return Storage::download($guidance->document, $fileName);
        }

        abort(404);
    }
}
