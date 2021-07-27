<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAssessmentScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,nim',
            'submission_id' => 'required|exists:submission_of_assessments,id',
            'date' => 'required|date|after:tomorrow',
            'start_time' => 'required',
            'finish_time' => 'required',
        ];
    }
}
