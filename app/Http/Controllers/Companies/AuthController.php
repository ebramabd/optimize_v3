<?php

namespace App\Http\Controllers\Companies;

use App\Enums\CompanyStatus;
use App\Enums\OtpStatus;
use App\Enums\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\CompanyRequest;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Otp;
use App\Models\ProcessServiceData;
use App\Models\User;
use App\Services\AuthService;
use App\Services\CompanyService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $companyService;

    protected AuthService $authService;

    public function __construct(CompanyService $companyService, AuthService $authService)
    {
        $this->companyService = $companyService;
        $this->authService = $authService;

    }

    public function authentication()
    {
        $uniquePageKey = $this->authService->getUniquePageKey();
        return view('companies.authentication', compact('uniquePageKey'));
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $company = Company::where('email', $request->email)->first();

        if ($company && Hash::check($request->password, $company->password)) {
            if ($company->status !== CompanyStatus::Active){
                return back()->with('error', 'this accent is not active ');
            }
            Auth::guard('company')->login($company);

            $activeSubscription = CompanySubscription::where([
                'company_id' => $company->id,
                'status' => SubscriptionStatus::Active
            ])->first();

            if (now()->greaterThan($company->trial_ends_at) && !$activeSubscription) {
                return redirect()->route('companies.setting.subscriptions');
            }

            return redirect()->route('companies.home');
        }
        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect()->route('companies.auth');
    }

    public function register(CompanyRequest $request)
    {
        /** check otp status */
        $otp = Otp::where('unique_key', $request->unique_key)->first();
        if (!$otp || $otp->status != OtpStatus::Active->value) {
            return redirect()->back()->with('error' , __('messages.Please Validate Otp'));
        }
        $company =  $this->companyService->save_company($request);
        if($company){
            return redirect()->back()->with('success' , 'The request has been submitted');
        }
        return redirect()->back()->with('error' , __('messages.error_msg'));
    }


}
