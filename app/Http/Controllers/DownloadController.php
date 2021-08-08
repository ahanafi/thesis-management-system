<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    private $documentPath;
    private $localDisk = null;

    public function __construct()
    {
        $this->documentPath = 'public/examples/';
        $this->localDisk = Storage::disk('local');
    }

    private function isExists($fileName)
    {
        $fullPath = $this->documentPath . $fileName . '.xlsx';
        return $this->localDisk->exists($fullPath);
    }

    public function sampleLecturerDataFormat()
    {
        if ($this->isExists('dosen')) {
            return $this->localDisk->download($this->documentPath . 'dosen.xlsx');
        } else {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Maaf dokumen format contoh import data dosen tidak ditemukan.',
                    'timer' => 5000,
                ]);
        }
    }

    public function sampleStudentDataFormat()
    {
        if ($this->isExists('mahasiswa')) {
            return $this->localDisk->download($this->documentPath . 'mahasiswa.xlsx');
        } else {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Maaf dokumen format contoh import data mahasiswa tidak ditemukan.',
                    'timer' => 5000,
                ]);
        }
    }

    public function sampleScienceFieldDataFormat()
    {
        if ($this->isExists('bidang-ilmu')) {
            return $this->localDisk->download($this->documentPath . 'bidang-ilmu.xlsx');
        } else {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Maaf dokumen format contoh import data bidang ilmu tidak ditemukan.',
                    'timer' => 5000,
                ]);
        }
    }

    public function sampleDataSetFormat()
    {
        if ($this->isExists('data-set')) {
            return $this->localDisk->download($this->documentPath . 'data-set.xlsx');
        } else {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Maaf dokumen format contoh data set skripsi tidak ditemukan.',
                    'timer' => 5000,
                ]);
        }
    }
}
