<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'ascii' => 'The :attribute must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute must have between :min and :max items.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute must be between :min and :max.',
        'string' => 'The :attribute must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'decimal' => 'The :attribute must have :decimal decimal places.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lowercase' => 'The :attribute must be lowercase.',
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute must not have more than :max items.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute must be uppercase.',
    'url' => 'The :attribute must be a valid URL.',
    'ulid' => 'The :attribute must be a valid ULID.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'brand_name' => [
            'required' => 'The company name is required.',
        ],
        'company_name' => [
            'required' => 'The company name is required.',
        ],
        'trade_name' => [
            'required' => 'The trade name is required.',
        ],
        'commercial_registration_number' => [
            'required' => 'The commercial registration number is required.',
            'integer' => 'The commercial registration number must be a number.',
        ],
        'tax_number' => [
            'integer' => 'The tax number must be a number.',
        ],
        'owner_name' => [
            'required' => 'The owner name is required.',
        ],
        'phone_number' => [
            'required' => 'The phone number is required.',
        ],
        'email' => [
            'required' => 'The email field is required.',
            'email' => 'Please enter a valid email address.',
            'unique' => 'This email is already registered.',
        ],
        'password' => [
            'required' => 'The password is required.',
            'min' => 'The password must be at least 8 characters.',
            'confirmed' => 'The password confirmation does not match.',
        ],
        'status' => [
            'required' => 'The status is required.',
        ],
        'file_commercial' => [
            'required' => 'The commercial file is required.',
        ],
        'file_tax' => [
            'required' => 'The tax file is required.',
        ],
        'brand_id' => [
            'required' => 'The brand id name is required.',
        ],
        'item_name' => [
            'required' => 'The item name is required.',
        ],
        'service_name' => [
            'required' => 'The service name is required.',
        ],
        'name' => [
            'required' => 'The name is required.',
        ],
        'last_name' => [
            'required' => 'The last name is required.',
        ],
        'phone' => [
            'required' => 'The phone number is required.',
        ],
        'type' => [
            'required' => 'The type is required.',
            'integer' => 'The type must be an integer.',
        ],
        'category' => [
            'required' => 'The category is required.',
        ],
        'color' => [
            'required' => 'The color is required.',
        ],
        'year_of_manufacture' => [
            'required' => 'The year of manufacture is required.',
            'integer' => 'The year must be an integer.',
            'min' => 'The year must be at least 1900.',
            'max' => 'The year must not be in the future.',
        ],
        'plate_number' => [
            'required' => 'The plate number is required.',
            'numeric' => 'The plate number must be a number.',
        ],
        'meter_reading' => [
            'required' => 'The meter reading is required.',
            'numeric' => 'The meter reading must be a number.',
            'min' => 'The meter reading must be at least 0.',
            'max' => 'The meter reading must be less than 99999999.99.',
        ],
        'service_id' => [
            'required' => 'The service is required.',
        ],
        'brand_ids' => [
            'required' => 'The brand is required.',
        ],
        'item_ids' => [
            'required' => 'The item is required.',
        ],
        'application_area' => [
            'required' => 'The application area is required.',
            'array' => 'The application area must be an array.',
        ],
        'cost' => [
            'required' => 'The cost is required.',
        ],
        'branch_id' => [
            'required' => 'The branch is required.',
            'integer' => 'The type must be an integer.',
        ],
        'administrator' => [
            'required' => 'The administrator is required.',
        ],
        'images' => [
            'required' => 'Images are required.',
            'image' => 'Each file must be an image.',
            'mimes' => 'Images must be of type: jpeg, png, jpg, gif, svg.',
            'max' => 'Images may not be greater than 2MB.',
        ],
        'title' => [
            'required' => 'The title is required.',
        ],
        'period' => [
            'required' => 'The period is required.',
            'integer' => 'The period must be an integer.',
            'min' => 'The period must be at least 1.',
        ],
        'price' => [
            'required' => 'The price is required.',
            'numeric' => 'The price must be a number.',
            'min' => 'The price must be at least 0.',
        ],
        'description' => [
            'required' => 'The description is required.',
            'array' => 'The description must be an array.',
        ],
        'condition_text' => [
            'required' => 'The condition text is required.',
            'min' => 'The condition text must be at least 3 characters.',
            'max' => 'The condition text may not be greater than 5000 characters.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
