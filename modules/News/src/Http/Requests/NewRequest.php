<?php

namespace Modules\News\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRequest extends FormRequest
{
    /**
     * Determine if the news is authorized to make this request.
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
            'content' => 'required',
            'new_category_id' => ['required', 'integer', function ($attribute, $value, $failed) {
                if ($value == 0) {
                    $failed(__('news::validation.select'));
                }
            }],
            'teacher_id' => ['required', 'integer', function ($attribute, $value, $failed) {
                if ($value == 0) {
                    $failed(__('courses::validation.select'));
                }
            }],
            'thumbnail' => 'required|max:255',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('news::validation.required'),
            'email' => __('news::validation.email'),
            'unique' => __('news::validation.unique'),
            'min' => __('news::validation.min'),
            'max' => __('news::validation.max'),
            'integer' => __('news::validation.integer'),
        ];
    }

    public function attributes(): array
    {
        return __('news::validation.attributes');
    }
}
