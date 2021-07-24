<?php


namespace App\Services;


use App\Models\Thesis;
use Illuminate\Support\Facades\Storage;

class DownloadThesisDocumentService
{
    public $thesis;
    private $documentType;

    public function __construct(Thesis $thesis)
    {
        $thesis->load(['student']);

        $this->thesis = $thesis;
    }

    public function setDocumentTyppe($type)
    {
        $this->documentType = $type;
    }

    public function download()
    {
        return $this->{$this->documentType}();

//        if ($this->documentType === 'report') {
//            return $this->report();
//        }
//
//        if ($this->documentType === 'application') {
//            return $this->application();
//        }
//
//        if ($this->documentType === 'journal') {
//            return $this->journal();
//        }
    }

    private function report()
    {
        if ($this->thesis->document !== null && Storage::exists($this->thesis->document)) {
            $splitFileName = explode('.', $this->thesis->document);
            $fileExtension = end($splitFileName);
            $fileName = "Laporan_Skripsi_" . $this->thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($this->thesis->document, $fileName);
        }
    }

    private function application()
    {
        if ($this->thesis->application !== null && Storage::exists($this->thesis->application)) {
            $splitFileName = explode('.', $this->thesis->application);
            $fileExtension = end($splitFileName);
            $fileName = "Program_Skripsi_" . $this->thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($this->thesis->application, $fileName);
        }
    }

    private function journal()
    {
        if ($this->thesis->journal !== null && Storage::exists($this->thesis->journal)) {
            $splitFileName = explode('.', $this->thesis->journal);
            $fileExtension = end($splitFileName);
            $fileName = "Jurnal_Skripsi_" . $this->thesis->student->getName() . '.' . $fileExtension;

            return Storage::download($this->thesis->journal, $fileName);
        }
    }
}
