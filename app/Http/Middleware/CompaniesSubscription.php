<?php

namespace App\Http\Middleware;

use App\Enums\CompanyStatus;
use App\Enums\SubscriptionStatus;
use App\Models\CompanySubscription;
use Closure;
use Illuminate\Http\Request;

class CompaniesSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $company = auth()->guard('company')->user();

        if (!$company) {
            return redirect()->route('welcome');
        }

        $activeSubscription = CompanySubscription::where([
            'company_id' => $company->id,
            'status' => SubscriptionStatus::Active
        ])->first();

        // Case 1: Trial expired and no active subscription
        if (
            (is_null($company->trial_ends_at) || now()->greaterThan($company->trial_ends_at)) &&
            !$activeSubscription
        ) {
            return redirect()->route('companies.setting.subscriptions')->with('error' , 'You are not a subscriber');
        }

        // Case 2: Has an active subscription, but it's expired
        if ($activeSubscription && now()->greaterThan($activeSubscription->end_date)) {
            $activeSubscription->update(['status' => SubscriptionStatus::Expired]);
            return redirect()->route('companies.setting.subscriptions')->with('error' , 'You are not a subscriber');
        }

        return $next($request);
    }

}
