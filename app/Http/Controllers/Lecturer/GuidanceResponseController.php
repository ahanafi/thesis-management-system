<?php

namespace App\Http\Controllers\Lecturer;

use App\Constants\GuidanceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitSupervisorResponseRequest;
use App\Models\Guidance;
use App\Models\SupervisorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuidanceResponseController extends Controller
{
    public function reply(Guidance $guidance)
    {
        $guidance->load(['student', 'thesis', 'response']);

        if ($guidance->status === GuidanceStatus::SENT) {
            $guidance->setStatus(GuidanceStatus::REVIEW);
        }

        return viewLecturer('guidance-response.reply', compact('guidance'));
    }

    public function store(SubmitSupervisorResponseRequest $request, Guidance $guidance)
    {
        $supervisorResponse = new SupervisorResponse();
        $supervisorResponse->guidance_id = $guidance->id;
        $supervisorResponse->response = $request->response;

        if ($request->hasFile('document')) {
            $document = $request->file('document')->store('documents/guidance/response');
            $supervisorResponse->document = $document;
        }

        if ($supervisorResponse->save()) {
            $guidance->setStatus(GuidanceStatus::REPLIED);

            $message = setFlashMessage('success', 'insert', 'tanggapan bimbingan skripsi');
        } else {
            $message = setFlashMessage('error', 'insert', 'tanggapan bimbingan skripsi');
        }

        return redirect()->route('lecturer.mentoring.guidance.show', $guidance->id)->with('message', $message);
    }

    public function edit(SupervisorResponse $response)
    {
        $response->load(['guidance']);

        return viewLecturer('guidance-response.edit', compact('response'));
    }

    public function update(SubmitSupervisorResponseRequest $request, SupervisorResponse $response)
    {
        $response->response = $request->response;

        if ($request->hasFile('document')) {

            if($response->document !== null && Storage::exists($response->document)) {
                Storage::delete($response->document);
            }

            $document = $request->file('document')->store('documents/guidance/response');
            $response->document = $document;
        }

        if ($response->update()) {
            $message = setFlashMessage('success', 'update', 'tanggapan bimbingan skripsi');
        } else {
            $message = setFlashMessage('error', 'update', 'tanggapan bimbingan skripsi');
        }

        return redirect()->route('lecturer.mentoring.guidance.show', $response->guidance->id)->with('message', $message);
    }
}
