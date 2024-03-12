<?php

namespace Modules\Categories\src\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the categories is authorized to make this request.
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
        ];


        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => __('categories::validation.required'),
            'min' => __('categories::validation.min'),
            'integer' => __('categories::validation.integer'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('categories::validation.attributes.name'),
            'slug' => __('categories::validation.attributes.slug'),
            'parent_id' => __('categories::validation.attributes.parent_id'),
        ];
    }
}
