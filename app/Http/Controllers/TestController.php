<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function sendCarReady()
    {
        $check_res = $this->messageService->sendCarReady(
            recipientPhone: "+201005669140",
            carOwnerName: "هشام",
            companyName: "drive shield"
        );
        dd($check_res);
    }

    public function sendServiceAgreement()
    {
        $check_res = $this->messageService->sendServiceAgreement(
            recipientPhone: "+201090645427",
            carOwnerName: "هشام",
            companyName: "drive shield",
            mediaUrl: "media/agreement.pdf",
        );
        dd($check_res);
    }

    public function sendDeliveryNote()
    {
        $check_res = $this->messageService->sendDeliveryNote(
            recipientPhone: "+201501254785",
            carOwnerName: "ام",
            companyName: "drive shield",
            mediaUrl: "media/car.pdf",
        );
        dd($check_res);
    }

}
