<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCompanyRequest extends FormRequest
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
        $isUpdating = $this->has('update_service');

        return [
//            'service_name' => 'required',
            'brand_ids' => $isUpdating ? 'nullable' : 'required',
            'item_ids'  => $isUpdating ? 'nullable' : 'required',
        ];
    }

    public function messages()
    {
        return [
            'service_name.required' => __('validation.custom.service_name.required'),
            'brand_ids.required' => __('validation.custom.brand_id.required'),
            'item_ids.required' => __('validation.custom.item_id.required'),
        ];
    }

}
