<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuidanceRequest;
use App\Models\Guidance;
use App\Models\Thesis;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;

class GuidanceController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $supervisor = Thesis::getSupervisorOnly($nim);

        $firstSupervisorGuidances = Guidance::getByStudentId($nim, $supervisor->first_supervisor);
        $secondSupervisorGuidances = Guidance::getByStudentId($nim, $supervisor->second_supervisor);

        $guidances = [
            'first_supervisor' => $firstSupervisorGuidances,
            'second_supervisor' => $secondSupervisorGuidances
        ];

        return viewStudent('guidance.index', compact('guidances'));
    }

    public function create()
    {
        $nim = auth()->user()->registration_number;
        $supervisor = Thesis::getSupervisorOnly($nim);
        $supervisor->load(['firstSupervisor', 'secondSupervisor']);

        return viewStudent('guidance.create', compact('supervisor'));
    }

    public function store(GuidanceRequest $request)
    {
        $validated = $request->validated();

        $document = Storage::put('documents/guidance', $validated['document']);
        $nim = auth()->user()->registration_number;
        $thesis = Thesis::getSupervisorOnly($nim);

        $guidanceData = [
            'thesis_id' => $thesis->id,
            'nim' => auth()->user()->registration_number,
            'title' => $validated['title'],
            'note' => $validated['note'],
            'document' => $document,
        ];

        if (strtolower($validated['supervisor']) === 'all') {

            $guidanceData['nidn'] = $thesis->first_supervisor;
            Guidance::create($guidanceData);

            $guidanceData['nidn'] = $thesis->second_supervisor;
            Guidance::create($guidanceData);

        } else {
            $guidanceData['nidn'] = $validated['supervisor'];
            Guidance::create($guidanceData);
        }

        $message = setFlashMessage('success', 'create', 'bimbingan skripsi');

        return redirect()->route('student.guidance.index')->with('message', $message);
    }

    public function show(Guidance $guidance)
    {
        $guidance->load(['student', 'thesis']);
        return viewStudent('guidance.single', compact('guidance'));
    }

    public function edit(Guidance $guidance)
    {
        $nim = auth()->user()->registration_number;
        $thesis = Thesis::getSupervisorOnly($nim);
        $thesis->load(['firstSupervisor', 'secondSupervisor']);

        $supervisorName = $guidance->nidn === $thesis->first_supervisor ? $thesis->firstSupervisor->getNameWithDegree() : $thesis->secondSupervisor->getNameWithDegree();

        return viewStudent('guidance.edit', compact('guidance', 'supervisorName'));
    }

    public function update(GuidanceRequest $request, Guidance $guidance)
    {
        $validated = $request->validated();

        if($request->hasFile('document')) {
            $guidance->document = $request->file('document')->store('documents/guidance');
        }

        $guidance->title = $validated['title'];
        $guidance->note = $validated['note'];

        if($guidance->update()) {
            $message = setFlashMessage('success', 'update', 'bimbingan skripsi');
        } else {
            $message = setFlashMessage('error', 'update', 'bimbingan skripsi');
        }

        return redirect()->route('student.guidance.index')->with('message', $message);
    }
}
