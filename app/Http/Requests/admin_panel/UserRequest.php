<?php

namespace App\Http\Requests\admin_panel;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'type' => ['required', 'integer'],

            'branch_id' => array_filter([
                $this->type == UserType::Branch_Administrator ? 'required' : 'nullable',
                'integer',
            ]),

            'password' => ($this->id == null && $this->type != UserType::Client)
                ? ['required', 'string', 'min:4', 'confirmed']  // Required when creating a non-client user
                : ['nullable', 'string', 'min:4', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.custom.name.required'),
            'last_name.required' => __('validation.custom.last_name.required'),
            'phone.required' => __('validation.custom.phone.required'),
            'email.required' => __('validation.custom.email.required'),
            'email.email' => __('validation.custom.email.email'),
            'type.required' => __('validation.custom.type.required'),
            'type.integer' => __('validation.custom.type.integer'),
            'password.required' => __('validation.custom.password.required'),
            'password.min' => __('validation.custom.password.min'),
            'password.confirmed' => __('validation.custom.password.confirmed'),
        ];
    }
}
