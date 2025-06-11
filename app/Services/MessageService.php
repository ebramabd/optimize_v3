<?php

namespace App\Services;

use App\Enums\OtpStatus;
use App\Models\ExtraService;
use App\Models\Otp;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Twilio\Rest\Client;
use App\Services\SMSService;

class MessageService
{

    public function availableInSecondsVerificationCode(string $phoneNumber): int
    {
        $available_in_seconds = RateLimiter::availableIn('send-auth-phone-code-verification:' . $phoneNumber);
        return $available_in_seconds;
    }

    public function sendPhoneCodeVerification(string $phoneNumber, string $unique_key)
    {
        /** wait 120 seconds to send another sms */
        $executed = RateLimiter::attempt(
            key: 'send-auth-phone-code-verification:' . $phoneNumber,
            maxAttempts: 1,
            decaySeconds: 120,
            callback: function () use ($phoneNumber, $unique_key) {
                $otp = $this->createOtp(user: auth()->user(), unique_key: $unique_key);
                // $body = $otp->code . ' is Your Car Reservation Verification Code';
                // $send_res = $this->sendSMS(
                //     recipient: $phoneNumber,
                //     body: $body
                // );


                // $parameters[1] = (string) $otp->code;
                // $send_res = $this->sendWhatsApp(
                //     recipient: $phoneNumber,
                //     templateSID: config('twilio.twilio_otp_template_sid'),
                //     parameters: $parameters,
                // );
                $message = "*{$otp->code}* is your verification code. For your security, do not share this code.";
                // Send via Taqnyat
                $send_res = SMSService::send(
                    message: $message,
                    recipients: $phoneNumber
                );
                return $send_res;
           },
        );
        $available_in_seconds = $this->availableInSecondsVerificationCode(phoneNumber: $phoneNumber);
        if (!$executed) {
            return [
                'status' => false,
                'available_in_seconds' => $available_in_seconds,
                'message' => __('Too many attempts! You may try again in') . ' ' . $available_in_seconds . ' ' . __('Seconds'),
            ];
        }

        $res = $executed;
        $res['available_in_seconds'] = $available_in_seconds;
        return $res;
    }

    public function sendCarReady(
        int $recipientPhone,
        String $carOwnerName,
        String $companyName,
    ) {

        //$parameters[1] = $carOwnerName;
        //$parameters[2] = $companyName;

        // $send_res = $this->sendWhatsApp(
        //     recipient: $recipientPhone,
        //     templateSID: config('twilio.twilio_car_ready_template_sid'),
        //     parameters: $parameters,
        // );

        $message = "عزيزي {$carOwnerName}\nسيارتك جاهزه للإستلام\nشكرا لإختيارك {$companyName}";
        // Send via Taqnyat
        $send_res = SMSService::send(
            message: $message,
            recipients: (string) $recipientPhone

        );
        return $send_res;
    }

    /**
     * @param string $mediaUrl path to the media file (e.g. 'public/media/delivery_note.pdf').
     */
    public function sendServiceAgreement(
        int $recipientPhone,
        String $carOwnerName,
        String $companyName,
        String $mediaUrl,
    ) {


        // $parameters[1] = $carOwnerName;
        // $parameters[2] = $companyName;
        // $parameters[3] = $mediaUrl;

        // $send_res = $this->sendWhatsApp(
        //     recipient: $recipientPhone,
        //     templateSID: config('twilio.twilio_service_agreement_template_sid'),
        //     parameters: $parameters,
        // );


        $fullMediaUrl = $mediaUrl;
        if (!preg_match('/^https?:\/\//', $mediaUrl)) {
            $fullMediaUrl = rtrim(config('app.url'), '/') . '/' . ltrim($mediaUrl, '/');
        }

        $message = "اتفاقية تقديم الخدمة\n";
        $message .= "عزيزي {$carOwnerName}\n";
        $message .= "شكرا لاختيارك {$companyName}\n";
        $message .= $fullMediaUrl;
        // Send via Taqnyat
        $send_res = SMSService::send(
            message: $message,
            recipients: (string) $recipientPhone

        );
        return $send_res;
    }

    /**
     * @param string $mediaUrl path to the media file (e.g. 'public/media/delivery_note.pdf').
     */
    public function sendDeliveryNote(
        int $recipientPhone,
        String $carOwnerName,
        String $companyName,
        String $mediaUrl,
    ) {

        // $parameters[1] = $carOwnerName;
        // $parameters[2] = $companyName;
        // $parameters[3] = $mediaUrl;

        // $send_res = $this->sendWhatsApp(
        //     recipient: $recipientPhone,
        //     templateSID: config('twilio.twilio_delivery_note_template_sid'),
        //     parameters: $parameters,
        // );

        $fullMediaUrl = $mediaUrl;
        if (!preg_match('/^https?:\/\//', $mediaUrl)) {
            $fullMediaUrl = rtrim(config('app.url'), '/') . '/' . ltrim($mediaUrl, '/');
        }
        $message = "سند تسليم المركبة\n";
        $message .= "عزيزي {$carOwnerName}\n";
        $message .= "تم تسليم المركبة الخاصة بك بنجاح\n";
        $message .= "شكرا لاختيارك {$companyName}\n";
        $message .= $fullMediaUrl;
        // Send via Taqnyat
        $send_res = SMSService::send(
            message: $message,
            recipients: (string) $recipientPhone

        );
        return $send_res;
    }

    public function sendWhatsApp(
        string $recipient,
        string $templateSID,
        array $parameters = [],
        ?String $mediaUrl = null,
    ) {
        $account_sid = config('twilio.account_sid');
        $auth_token = config('twilio.auth_token');
        $twilio_whatsapp_number = config('twilio.twilio_whatsapp_number');
        $client = new Client($account_sid, $auth_token);
        $messageData = [
            'from' => $twilio_whatsapp_number,
            'to' => "whatsapp:$recipient",
            'contentSid' => $templateSID,
            'contentVariables' => json_encode($parameters),
        ];
        $message =  $client->messages->create($messageData['to'], $messageData);
        if ($message->sid ?? false) {
            return [
                'status' => true,
                'provider_msg_id' => $message->sid,
                'sent_status' => $message->status
            ];
        } else {
            return [
                'status' => false,
                'msg' => 'Something went Wrong, try later'
            ];
        }
    }

    protected function createOtp(?User $user, ?string $unique_key): Otp
    {
        $code = mt_rand(100000, 999999);
        $otp = Otp::updateOrCreate(
            [
                'user_id' => $user?->id,
                'unique_key' => $unique_key,
            ],
            [
                'code' => $code,
                'tries_count' => 0,
            ]
        );
        return $otp;
    }

    public function verifyPhoneCode(string $code, string $unique_key): array
    {
        $otp = Otp::where('unique_key', $unique_key)->firstOrFail();
        $res = $this->checkOtp(code: $code, otp: $otp);
        if (! $res['status']) {
            return $res;
        }
        $otp->status = OtpStatus::Active->value;
        $otp->save();
        return [
            'status' => true
        ];
    }

    protected function checkOtp(string $code, Otp $otp): array
    {
        if ($otp->tries_count >= 5) {
            return [
                'status' => false,
                'message' => 'Too many attempts! Please Resend a new Code',
            ];
        }
        /** increase tries_count */
        $old_tries_count = $otp->tries_count;
        $otp->tries_count = $old_tries_count + 1;
        $otp->save();

        if ($otp->code == $code) {
            return [
                'status' => true,
            ];
        } else {
            $rest_attempts = 5 - $otp->tries_count;
            return [
                'status' => false,
                'message' => 'The Code Is Wrong You Have ' . $rest_attempts . ' Attempts',
            ];
        }
    }
}
