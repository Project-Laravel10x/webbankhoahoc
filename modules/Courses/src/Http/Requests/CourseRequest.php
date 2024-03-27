<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the courses is authorized to make this request.
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
        $id = $this->route()->course;
        $uniqueRule = 'unique:courses,code';
        if ($id){
            $uniqueRule = "unique:courses,code,$id";
        }
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function ($attribute, $value, $failed) {
                if ($value == 0) {
                    $failed(__('courses::validation.select'));
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => "required|max:255|$uniqueRule",
            'is_document' => 'required|integer',
            'support' => 'required',
            'status' => 'required|integer',
            'shoft_description' => 'required',
            'categories' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('courses::validation.required'),
            'email' => __('courses::validation.email'),
            'unique' => __('courses::validation.unique'),
            'min' => __('courses::validation.min'),
            'max' => __('courses::validation.max'),
            'integer' => __('courses::validation.integer'),
        ];
    }

    public function attributes(): array
    {
        return __('courses::validation.attributes');
    }
}
