<?php

namespace Modules\Teacher\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the teacher is authorized to make this request.
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
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'image' => 'required',
            'description' => 'required',
            'exp' => 'required|integer',
            'major' => 'required',
        ];


        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('teacher::validation.required'),
            'max' => __('teacher::validation.max'),
            'integer' => __('teacher::validation.integer'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('teacher::validation.attributes.name'),
            'slug' => __('teacher::validation.attributes.slug'),
            'image' => __('teacher::validation.attributes.image'),
            'description' => __('teacher::validation.attributes.description'),
            'exp' => __('teacher::validation.attributes.exp'),
            'major' => __('teacher::validation.attributes.major'),
        ];
    }
}
