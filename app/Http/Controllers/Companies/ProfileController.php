<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\CompanyRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Item;
use App\Services\CompanyService;
use App\Services\TermsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        $company = auth()->guard('company')->user();
        return view('companies.setting.profile.index' ,compact('company'));
    }

    public function profile_edit(CompanyRequest $request , $id)
    {
        $object = $this->companyService->save_company($request, $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function update_profile_picture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $company = auth()->guard('company')->user();
        if ($company->profile_picture) {
            $image = $company->profile_picture;
            \Storage::delete('public/' . $image);
        }

        if ($request->hasFile('profile_picture')) {
            $fileTax = $request->file('profile_picture');
            $filenameTax = time() . '_' . $fileTax->getClientOriginalName();
            $filePathTax = $fileTax->storeAs('uploads', $filenameTax, 'public');
            Company::where('id' , $company->id)->update(['profile_picture'=>$filePathTax]);
            return response()->json(['success' => true, 'image_path' => asset("storage/$filePathTax")]);
        }

        return response()->json(['success' => false], 400);

    }

    public function update_password(Request $request , $id)
    {
        $request->validate([
            'password' => 'required|min:4|confirmed',
        ]);

        $company = $this->companyService->getOneObject(new Company() , 'id' ,$id);

        if (!$company) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }

        $company->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'password updated successful.');
    }
}
