<?php

namespace Modules\Students\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Students\src\Models\Student;

class StudentEditProfileRequest extends FormRequest
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
        $id = Auth::guard('students')->user()->id;

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $id,
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'address' => 'required',
        ];

        if ($this->filled('old_password')) {
            $rules['old_password'] = function ($attribute, $value, $fail) use ($id) {
                $student = Student::find($id);
                if (!Hash::check($value, $student->password)) {
                    $fail(__('Mật khẩu hiện tại không chính xác.'));
                }
            };

        }
        else {
            if ($this->filled('password') || $this->filled('password_confirmation')) {
                $rules['old_password'] = 'required';
            }
        }

        if ($this->filled('old_password')) {
            $rules['password'] = 'required|min:6|confirmed';
            $rules['password_confirmation'] = 'min:6';
        }



        return $rules;
    }


    public function messages(): array
    {
        return [
            'required' => __('students::validation.required'),
            'min' => __('students::validation.min'),
            'max' => __('students::validation.max'),
            'email' => __('students::validation.email'),
            'unique' => __('students::validation.unique'),
            'regex' => __('students::validation.regex'),
            'integer' => __('students::validation.integer'),
            'confirmed' => __('students::validation.confirmed'),
        ];
    }

    public function attributes(): array
    {
        return __('students::validation.attributes');
    }
}
