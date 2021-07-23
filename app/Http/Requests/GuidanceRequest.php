<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuidanceRequest extends FormRequest
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
            'title' => 'required',
            'note' => 'required',
            'document' => 'required|mimes:zip,rar,pdf,doc,docx',
            'supervisor' => 'required'
        ];
    }
}
