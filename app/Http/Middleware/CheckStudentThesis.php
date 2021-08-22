<?php

namespace App\Http\Middleware;

use App\Models\Thesis;
use Closure;
use Illuminate\Http\Request;

class CheckStudentThesis
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $nim = auth()->user()->registration_number;
        if (!Thesis::studentId($nim)->first()) {
            return redirect()->back()->with('message', [
                'type' => 'info',
                'text' => 'Data skripsi tidak ditemukan!. Silahkan buat pengajuan proposal Skripsi terlebih dahulu!',
                'timer' => 5000
            ]);
        }

        return $next($request);
    }
}
