<?php

namespace Modules\NewsCategories\src\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class NewsCategoryRequest extends FormRequest
{
    /**
     * Determine if the newscategories is authorized to make this request.
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
            'required' => __('newscategories::validation.required'),
            'min' => __('newscategories::validation.min'),
            'integer' => __('newscategories::validation.integer'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('newscategories::validation.attributes.name'),
            'slug' => __('newscategories::validation.attributes.slug'),
            'parent_id' => __('newscategories::validation.attributes.parent_id'),
        ];
    }
}
