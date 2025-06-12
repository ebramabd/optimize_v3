<?php

namespace App\Http\Controllers\Companies;

use App\Enums\OtpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\ProcessServiceRequest;
use App\Models\Administrator;
use App\Models\Branch;
use App\Models\BranchServices;
use App\Models\Company;
use App\Models\Otp;
use App\Models\Service;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ProcessService;
use App\Services\ServiceService;
use App\Services\TermsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CarFormController extends Controller
{
    protected $processService;
    protected AuthService $authService;

    public function __construct(ProcessService $processService, AuthService $authService)
    {
        $this->processService = $processService;
        $this->authService = $authService;
    }

    public function get_form()
    {
        //create
        $company_id =auth()->guard('company')->user()->id;
        $data['services'] = $this->processService->getAllObject(new Service());
        $data['items'] = Service::get_items();
        $data['companies'] = Branch::where('company_id' , $company_id)->get();
        $data['administrator'] = Administrator::where('company_id' , $company_id)->get();

        $data['selectServices'] = $this->processService->get_select_services($company_id);

        $uniquePageKey = $this->authService->getUniquePageKey();
        $data['uniquePageKey'] = $uniquePageKey;

        return view('companies.car_form.save' , $data);
    }

    public function save_order(ProcessServiceRequest $request)
    {

        /** check otp status */

       $otp = Otp::where('unique_key', $request->unique_key)->first();
       if (!$otp || $otp->status != OtpStatus::Active->value) {
//           return redirect()->back()->with('error', __('Please Validate Otp'));
       }

       $object =  $this->processService->save_process($request);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }


}


