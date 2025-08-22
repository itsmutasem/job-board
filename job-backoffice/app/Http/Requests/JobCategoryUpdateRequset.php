<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobCategoryUpdateRequset extends FormRequest
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
        'name' => 'required|string|max:255|unique:job_categories,name,' . $this->$category->id,
//            'name' => ['required', 'string', 'max:255', Rule::unique('job_categories', 'name')->ignore($this->$category->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name has already been token.',
            'name.max' => 'The category name must be less then 255 characters.',
            'name.string' => 'The category name must be a string.',
        ];
    }
}
