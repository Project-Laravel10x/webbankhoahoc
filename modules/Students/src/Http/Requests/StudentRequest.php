<?php

namespace Modules\Students\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the students is authorized to make this request.
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
        $id = $this->route()->student;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:students',
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'password' => 'required|min:6',
            'address' => 'required',
//            'is_active' => 'required|integer',
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:students,email,' . $id;
            if ($this->password) {
                $rules['password'] = 'min:6';
            } else {
                unset($rules['password']);
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('students::validation.required'),
            'min' => __('students::validation.min'),
            'email' => __('students::validation.email'),
            'unique' => __('students::validation.unique'),
            'regex' => __('students::validation.regex'),
            'integer' => __('students::validation.integer'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('students::validation.attributes.name'),
            'email' => __('students::validation.attributes.email'),
            'phone' => __('students::validation.attributes.phone'),
            'password' => __('students::validation.attributes.password'),
            'address' => __('students::validation.attributes.address'),
            'is_active' => __('students::validation.attributes.is_active'),
        ];
    }
}
