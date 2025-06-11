<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'period'      => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('validation.custom.title.required'),
            'period.required' => __('validation.custom.period.required'),
            'period.integer' => __('validation.custom.period.integer'),
            'period.min' => __('validation.custom.period.min'),
            'price.required' => __('validation.custom.price.required'),
            'price.numeric' => __('validation.custom.price.numeric'),
            'price.min' => __('validation.custom.price.min'),
            'description.required' => __('validation.custom.description.required'),
            'description.array' => __('validation.custom.description.array'),
        ];
    }

}
