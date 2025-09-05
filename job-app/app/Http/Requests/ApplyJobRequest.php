<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'resume_file' => 'bail|required|file|mimes:pdf|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'resume_file.required' => 'The resume file is required.',
            'resume_file.file' => 'The resume file must be a file.',
        ];
    }
}
