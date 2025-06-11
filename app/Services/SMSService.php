<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleHttpClient;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class SMSService
{
    /**
     * Send SMS to Saudi number using Taqnyat API
     *
     * @param string $message The message to send
     * @param string $recipients The recipient phone numbers, comma-separated
     * @return array Response from the API
     */
    public static function send(string $message, string $recipients): array
    {

        $apiUrl = 'https://api.taqnyat.sa/v1/messages';
        $bearerToken = config('services.taqnyat.bearer_token', 'dacefb1f873795a1690a02df294a149e');
        $apiKey = config('services.taqnyat.api_key', '4710f93567073fb98566ffafc');
        $sender = config('services.taqnyat.sender', 'DESCOAPI');
        $client = new GuzzleHttpClient();



        try {
           $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Content-Type'  => 'application/json',
                    'API-Key'       => $apiKey,
                ],
                'json' => [
                    'recipients' => $recipients,
                    'body'       => $message,
                    'sender'     => $sender,
                ],
                'timeout' => 10,
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info("SMS sent via Taqnyat", ['recipients' => $recipients, 'response' => $body]);
            $body['status'] = true;

            Log::info("SMS sent via Taqnyat body is ", ['body' => $body]);
            return [
                'success' => true,
                'response' => $body,
            ];

        } catch (\Exception $e) {
            Log::error("Failed to send SMS via Taqnyat", ['error' => $e->getMessage()]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
