<?php

namespace App\Http\Controllers\Admin_panel;

use App\Enums\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Http\Requests\admin_panel\SubscriptionRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Service;
use App\Models\Subscription;
use App\Services\BrandService;
use App\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $subscriptionService ;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->subscriptionService->get_subscriptions($request->all());
        }
        return view('admin_panel.subscriptions.index');
    }

    public function save($id = null)
    {
        $data = [];
        $data['object'] = $this->subscriptionService->getOneObject(model: new Subscription() , key: 'id' ,value: $id);
        return view('admin_panel.subscriptions.save' , $data );
    }

    public function save_post(SubscriptionRequest $request , $id = null)
    {
//        return $request;
        $object = $this->subscriptionService->save_subscription($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $object = $this->subscriptionService->getOneObject(model: new Subscription() , key: 'id' ,value: $id);
        return view('admin_panel.subscriptions.details', compact('object'));
    }

    public function delete($id)
    {
        $object = $this->subscriptionService->delete(model: new Subscription() ,id: $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function get_subscriptions_companies(Request $request)
    {
        if ($request->ajax()) {
            return $this->subscriptionService->get_subscriptions_companies($request->all());
        }
        return view('admin_panel.subscriptions.sub_companies');
    }

    public function get_subscriptions_companies_details($id)
    {
        $object = CompanySubscription::get_subscriptions_companies($id);
        return view('admin_panel.subscriptions.sub_details', compact('object'));
    }

    public function accept_request(Request $request)
    {
//        return $request;
        $request->validate([
            'object_id' => 'required',
        ]);

        try {
            $object = CompanySubscription::findOrFail($request->object_id);
            $company = Company::findOrFail($object->company_id);
            $subscription_period = Subscription::findOrFail($object->subscription_id)->period;

            $startDate = now();
            $endDate = null;

            // Company is still in trial
            if (!now()->greaterThan($company->trial_ends_at)) {
                $startDate = Carbon::parse($company->trial_ends_at);
                $company->update(['trial_ends_at'=>null]);
            }

            //Company has active subscription (extend from end date)
            $activeSubscription = CompanySubscription::where([
                'company_id' => $object->company_id,
                'status' => SubscriptionStatus::Active
            ])->first();

            if ($activeSubscription) {
//                $startDate = Carbon::parse($activeSubscription->end_date);
                $activeSubscription->update([
                    'status' => SubscriptionStatus::Expired ,
                    'end_date' => now(),
                    ]);
            }

            $endDate = $startDate->copy()->addDays($subscription_period);

            $object->update([
                'start_date' => now(),
                'end_date' => now()->addDays($subscription_period),
                'status' => SubscriptionStatus::Active
            ]);

            return  redirect()->route('admin-panel.subscriptions.companies')
                ->with('success', 'Subscription created successfully.');
        } catch (\Exception $e) {
            \Log::error('Subscription creation failed: ' . $e->getMessage());
            return redirect()->route('admin-panel.subscriptions.companies')->with('error', 'An error occurred while creating the subscription.');
        }
    }

}
