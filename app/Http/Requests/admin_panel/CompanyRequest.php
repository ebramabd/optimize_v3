<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'commercial_registration_number' => 'required|integer',
            'tax_number' => 'nullable|integer',
            'owner_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password'  => [$this->id == null ? 'required' : 'nullable' ,'string' ,'min:4' , 'confirmed'],
            'status' => 'integer',
            'file_commercial' => $this->id == null ? 'required|mimes:jpg,png,pdf|max:50000' : 'nullable|mimes:jpg,png,pdf|max:50000',
            'file_tax' => $this->id == null ? 'mimes:jpg,png,pdf|max:50000' : 'nullable|mimes:jpg,png,pdf|max:50000',
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required'                     => __('validation.custom.company_name.required'),
            'trade_name.required'                       => __('validation.custom.trade_name.required'),
            'commercial_registration_number.required'   => __('validation.custom.commercial_registration_number.required'),
            'commercial_registration_number.integer'    => __('validation.custom.commercial_registration_number.integer'),
            'tax_number.integer'                        => __('validation.custom.tax_number.integer'),
            'owner_name.required'       => __('validation.custom.owner_name.required'),
            'phone_number.required'     => __('validation.custom.phone_number.required'),
            'email.required'            => __('validation.custom.email.required'),
            'email.email'               => __('validation.custom.email.email'),
            'email.unique'              => __('validation.custom.email.unique'),
            'password.required'         => __('validation.custom.password.required'),
            'password.min'              => __('validation.custom.password.min'),
            'password.confirmed'        => __('validation.custom.password.confirmed'),
            'status.required'           => __('validation.custom.status.required'),
            'file_commercial.required'  => __('validation.custom.file_commercial.required'),
            'file_tax.required'         => __('validation.custom.file_tax.required'),
        ];
    }
}
