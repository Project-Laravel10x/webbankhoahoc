<?php

namespace Modules\Lessons\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the lessons is authorized to make this request.
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
            'parent_id' => 'required|integer',
            'is_trial' => 'required|integer',
            'position' => 'required|integer',
        ];

        if ($this->parent_id !== 0){
            $rules['parent_id'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('lessons::validation.required'),
            'integer' => __('lessons::validation.integer'),
            'select' => __('lessons::validation.select'),
        ];
    }

    public function attributes(): array
    {
        return __('lessons::validation.attributes');
    }
}
