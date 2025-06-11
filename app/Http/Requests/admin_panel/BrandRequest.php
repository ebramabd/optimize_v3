<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'brand_name.required' => __('validation.custom.brand_name.required'),
        ];
    }
}
