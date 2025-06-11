<?php

namespace App\Http\Controllers\Companies;

use App\Enums\OtpStatus;
use App\Enums\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Otp;
use App\Models\ProcessServiceData;
use App\Models\Subscription;
use App\Services\AuthService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{

    protected MessageService $messageService;
    protected AuthService $authService;

    public function __construct(MessageService $messageService, AuthService $authService)
    {
        $this->messageService = $messageService;
        $this->authService = $authService;
    }

    public function welcome()
    {
        return view('companies.welcome');
    }

    public function setting()
    {
        return view('companies.setting.index');
    }

    public function home()
    {
        $data = [];
        $data['orders'] = ProcessServiceData::get_orders_home();
        $data['subscription']= $this->get_current_subscription();
        return view('companies.index', $data);
    }

    public function get_current_subscription()
    {
        $company = auth()->guard('company')->user();
        if ($company->trial_ends_at && now()->lte($company->trial_ends_at)) {
            return \Carbon\Carbon::parse($company->trial_ends_at);
        }


        $activeSubscription = CompanySubscription::where([
            'company_id' => $company->id,
            'status' => SubscriptionStatus::Active
        ])->first();
        if ($activeSubscription) {
            $end_date = $activeSubscription->end_date;
            $subscription = Subscription::where('id', $activeSubscription->subscription_id)->first();
            return [
                'subscription' => $subscription,
                'end_date' =>\Carbon\Carbon::parse($end_date),
            ];
        }
        return null;
    }

    public function recoverPassword()
    {
        $uniquePageKey = $this->authService->getUniquePageKey();
        return view('companies.recover-password' , compact('uniquePageKey'));
    }

    public function updatePasswordView($companyId)
    {
        return view('companies.update-password', compact('companyId'));
    }

    public function updatePassword(Request $request)
    {
//        return $request;
        $request->validate([
            'password' => 'required',
        ]);

        $company = Company::find($request->companyId);

        $company->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('companies.auth')->with('success', 'Your password has been updated successfully.');
    }

    function verificationCode()
    {
        return view('companies.verification-code');
    }

    function transition()
    {
        return view('screens.transition');
    }

}
