<?php

namespace App\Http\Controllers\Companies;

use App\Enums\CompanyStatus;
use App\Enums\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $data =[];
        $data['subscriptions'] = Subscription::all();
        $data['my_subscription'] = CompanySubscription::where('company_id' , auth()->guard('company')->user()->id)->get();
        return view('companies.setting.subscriptions.index', $data);
    }

    public function get_current_subscription()
    {
        $company = auth()->guard('company')->user();
        if (!now()->greaterThan($company->trial_ends_at)) {
            return \Carbon\Carbon::parse($company->trial_ends_at);
        }

        $activeSubscription = CompanySubscription::where([
            'company_id' => $company->id,
        ])->latest()->first();
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

    public function subscription_post(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:50000',
        ]);

        try {
            $filePath = null;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $filename, 'public');
            }

            CompanySubscription::create([
                'company_id' => auth()->guard('company')->user()->id,
                'subscription_id' => $request->subscription_id,
                'status' => SubscriptionStatus::Pending,
                'image' => $filePath
            ]);

            return back()->with('success', 'Subscription created successfully.');
        } catch (\Exception $e) {
            // You can log the error if needed
            \Log::error('Subscription creation failed: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while creating the subscription.');
        }
    }

}
