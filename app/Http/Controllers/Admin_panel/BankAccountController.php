<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Http\Requests\admin_panel\TermsRequest;
use App\Models\BankAccount;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Service;
use App\Models\TermsOfAgreement;
use App\Services\BrandService;
use App\Services\TermsService;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    protected $termService ;

    public function __construct(TermsService $termService)
    {
        $this->termService = $termService;
    }

    public function index()
    {
        $bank = BankAccount::where('id' , 1)->first();
        return view('admin_panel.payment' , compact('bank'));
    }

    public function edit(Request $request)
    {
        $bank = BankAccount::where('id' , 1)->first();
        $updated = $bank->update(['bank_account' => $request->bank_account]);
        if ($updated == null) {
            return redirect()->back()->with('error', 'this data not correct');
        }
        return redirect()->back()->with('success', 'The operation was successful.');
    }



}
