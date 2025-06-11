<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_name' => 'required|string|max:255',
            'branch_id' => array_filter([
                $this->branch != 'allBranch' ? 'required' : 'nullable',
                'integer',
            ]),
        ];
    }

    public function messages(): array
    {
        return [
            'service_name.required' => __('validation.custom.service_name.required'),
            'branch_id.required' => __('validation.custom.branch_id.required'),
        ];
    }
}
