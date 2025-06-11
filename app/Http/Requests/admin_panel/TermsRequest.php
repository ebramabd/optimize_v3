<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class TermsRequest extends FormRequest
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
            'condition_text' => 'required|string|min:3',
            'condition_text_ar' => 'required|string|min:3',
            'branch_id' => array_filter([
                $this->branch != 'allBranch' ? 'required' : 'nullable',
                'integer',
            ]),
        ];
    }

    public function messages()
    {
        return [
            'condition_text.required' => __('validation.custom.condition_text.required'),
            'condition_text.min' => __('validation.custom.condition_text.min'),
            'condition_text.max' => __('validation.custom.condition_text.max'),
            'branch_id.required' => __('validation.custom.branch_id.required'),
            'branch_id.integer' => __('validation.custom.branch_id.integer'),
        ];
    }

}
