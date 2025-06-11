<?php

return [
    'account_sid' => env('TWILIO_ACCOUNT_SID'),
    'auth_token' => env('TWILIO_AUTH_TOKEN'),
    'twilio_number' => env('TWILIO_Number'),
    'twilio_whatsapp_number' => env('TWILIO_WHATSAPP_Number'),
    'twilio_otp_template_sid' => env('TWILIO_OTP_TEMPLATE_SID'),
    'twilio_reserve_confirmation_template_sid' => env('TWILIO_RESERVE_CONFIRMATION_TEMPLATE_SID'),
    'twilio_car_ready_template_sid' => env('TWILIO_CAR_READY_TEMPLATE_SID'),
    'twilio_service_agreement_template_sid' => env('TWILIO_SERVICE_AGREEMENT_TEMPLATE_SID'),
    'twilio_delivery_note_template_sid' => env('TWILIO_DELIVERY_NOTE_TEMPLATE_SID'),
];
