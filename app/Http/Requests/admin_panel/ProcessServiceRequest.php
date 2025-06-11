<?php

namespace App\Http\Requests\admin_panel;

use Illuminate\Foundation\Http\FormRequest;

class ProcessServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'required|string|max:255',

            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . date('Y'), // Ensures a valid year
            'plate_number' => 'required|numeric',
            'meter_reading' => 'required|numeric|min:0|max:99999999.99',

            'service_id' => ['required'],

            'brand_ids' => ['required'],

            'item_ids' => ['required'],
            'application_area' => ['required', 'array'],

            'cost' =>  ['required'],
//            'branch_id' => 'required',
            'administrator' => 'required',

            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

//    public function messages()
//    {
//        return [
//            'name.required' => __('validation.custom.name.required'),
//            'last_name.required' => __('validation.custom.last_name.required'),
//            'email.required' => __('validation.custom.email.required'),
//            'email.email' => __('validation.custom.email.email'),
//            'phone.required' => __('validation.custom.phone.required'),
//
//            'type.required' => __('validation.custom.type.required'),
//            'category.required' => __('validation.custom.category.required'),
//            'color.required' => __('validation.custom.color.required'),
//            'year_of_manufacture.required' => __('validation.custom.year_of_manufacture.required'),
//            'year_of_manufacture.integer' => __('validation.custom.year_of_manufacture.integer'),
//            'year_of_manufacture.min' => __('validation.custom.year_of_manufacture.min'),
//            'year_of_manufacture.max' => __('validation.custom.year_of_manufacture.max'),
//
//            'plate_number.required' => __('validation.custom.plate_number.required'),
//            'plate_number.numeric' => __('validation.custom.plate_number.numeric'),
//
//            'meter_reading.required' => __('validation.custom.meter_reading.required'),
//            'meter_reading.numeric' => __('validation.custom.meter_reading.numeric'),
//            'meter_reading.min' => __('validation.custom.meter_reading.min'),
//            'meter_reading.max' => __('validation.custom.meter_reading.max'),
//
//            'service_id.required' => __('validation.custom.service_id.required'),
//            'brand_ids.required' => __('validation.custom.brand_ids.required'),
//            'item_ids.required' => __('validation.custom.item_ids.required'),
//            'application_area.required' => __('validation.custom.application_area.required'),
//            'application_area.array' => __('validation.custom.application_area.array'),
//
//            'cost.required' => __('validation.custom.cost.required'),
//            'branch_id.required' => __('validation.custom.branch_id.required'),
//            'administrator.required' => __('validation.custom.administrator.required'),
//
//            'images.*.required' => __('validation.custom.images.required'),
//            'images.*.image' => __('validation.custom.images.image'),
//            'images.*.mimes' => __('validation.custom.images.mimes'),
//            'images.*.max' => __('validation.custom.images.max'),
//        ];
//    }

}
