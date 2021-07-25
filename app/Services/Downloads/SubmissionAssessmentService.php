<?php


namespace App\Services\Downloads;


use App\Models\SubmissionAssessment;
use Illuminate\Support\Facades\Storage;

class SubmissionAssessmentService
{
    private $submission = null;
    private $documentType, $documentPath;
    public function __construct(SubmissionAssessment $submission)
    {
        $submission->load(['thesis']);
        $this->submission = $submission;
    }

    public function setDocumentType($type)
    {
        $this->documentType = $type;
        return $this;
    }

    private function setDocumentPath($path)
    {
        $this->documentPath = $path;
    }

    public function download($filename)
    {
        if($this->documentType === 'report') {
            $this->setDocumentPath($this->submission->document);
        }

        if($this->documentType === 'guidance-card-first-supervisor') {
            $this->setDocumentPath($this->submission->guidance_card_first_supervisor);
        }

        if($this->documentType === 'guidance-card-second-supervisor') {
            $this->setDocumentPath($this->submission->guidance_card_second_supervisor);
        }

        if ($this->documentPath !== null && Storage::exists($this->documentPath)) {
            $splitFileName = explode('.', $this->documentPath);
            $fileExtension = end($splitFileName);

            $fileName = $filename . '_' . $this->submission->thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($this->documentPath, $fileName);
        }
    }
}
