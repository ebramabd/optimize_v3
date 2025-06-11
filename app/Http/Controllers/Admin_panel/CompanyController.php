<?php

namespace App\Http\Controllers\Admin_panel;

use App\Enums\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\CompanyRequest;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService ;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->companyService->get_companies($request->all());
        }
        return view('admin_panel.companies.index');
    }

    public function save($id = null)
    {
        $object = $this->companyService->getOneObject(model: new Company() , key: 'id' ,value: $id);
        return view('admin_panel.companies.save' , compact('object'));
    }

    public function save_post(CompanyRequest $request , $id = null)
    {
        $object = $this->companyService->save_company($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $data = [];
        $data['object'] = $this->companyService->getOneObject(model: new Company() , key: 'id' ,value: $id);
        $data['activeSubscription'] = CompanySubscription::where([
            'company_id' => $id,
            'status' => SubscriptionStatus::Active
        ])->first();
        $data['subscription'] = Subscription::get();
        return view('admin_panel.companies.details', $data);
    }

    public function delete($id)
    {
        $object = $this->companyService->delete(model: new Company() ,id: $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function add_subscription(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);
        $periodSub = Subscription::findOrFail($request->subscription_id)->period;
        $startDate = now();
        $endDate = $startDate->copy()->addDays($periodSub);


        $object = CompanySubscription::create([
            'company_id'=>$request->company_id,
            'subscription_id'=>$request->subscription_id,
            'start_date'=>$startDate,
            'end_date'=>$endDate,
            'status'=>SubscriptionStatus::Active,
            'image'=>'by admin'
        ]);

        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}
