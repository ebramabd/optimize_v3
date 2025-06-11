<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\AuthService;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected MessageService $messageService;
    protected AuthService $authService;

    public function __construct(MessageService $messageService, AuthService $authService)
    {
        $this->messageService = $messageService;
        $this->authService = $authService;
    }

    public function sendPhoneCodeAuthVerification(Request $request)
    {
        $phone_number = '+' . $request->phoneNumber;
        $unique_key = $request->unique_key;
        if ($request->action == 'send_code') {
            $send_res = $this->messageService->sendPhoneCodeVerification(phoneNumber: $phone_number, unique_key: $unique_key);
            $available_in_seconds = $send_res['available_in_seconds'];
            if ($send_res['status']) {
                $request->session()->now('success', __('Otp Sent Successfully'));
            } else {
                $request->session()->now('error', $send_res['message']);
            }
        } else {
            $available_in_seconds = $this->messageService->availableInSecondsVerificationCode(phoneNumber: $phone_number);
        }
        $view = view('components.verification.auth-verification', compact('available_in_seconds', 'phone_number', 'unique_key'))->render();
        return response()->json(['view' => $view]);
    }

    public function verifyPhoneCode(Request $request)
    {
        $check_res = $this->messageService->verifyPhoneCode(code: $request->code, unique_key: $request->unique_key);
        return response()->json([
           'verifyPhoneCodeRes' => $check_res
        ]);
    }

    public function sendPhoneCodeAuthVerificationRecoverPassword(Request $request)
    {
        $companyId = $this->authService->checkCompany($request) ;

        if ($companyId == null){
            return redirect()->back();
        }

        $phone_number =  $request->phone_number;
        $unique_key = $request->unique_key;
        if ($request->action == 'send_code') {
            $send_res = $this->messageService->sendPhoneCodeVerification(phoneNumber: $phone_number, unique_key: $unique_key);
            $available_in_seconds = $send_res['available_in_seconds'];
            if ($send_res['status']) {
                $request->session()->now('success', __('Otp Sent Successfully'));
            } else {
                $request->session()->now('error', $send_res['message']);
            }
        } else {
            $available_in_seconds = $this->messageService->availableInSecondsVerificationCode(phoneNumber: $phone_number);
        }
        return view('companies.verification-code', compact('available_in_seconds', 'phone_number', 'unique_key' ,'companyId'));

    }
    
    public function verifyPhoneCodeRecoverPassword(Request $request)
    {
        $companyId =  $request->companyId;
        $check_res = $this->messageService->verifyPhoneCode(code: $request->code, unique_key: $request->unique_key);
        if ($check_res['status'] !== true){
            return redirect()->route('recover.password')->with('error', 'this data not correct');
        }
        return redirect()->route('update.password.view',$companyId);
    }
}
