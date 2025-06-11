<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'brand_id' => 'required|integer',
            'item_name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'brand_id.required' => __('validation.custom.brand_id.required'),
            'item_name.required' => __('validation.custom.item_name.required'),
        ];
    }
}
