<?php

namespace App\Services;

use App\Enums\CompanyStatus;
use App\Enums\UserType;
use App\Models\Company;
use App\Traits\Crud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CompanyService
{
    use Crud;

    public function get_companies($data)
    {
        $model = $this->getAllObject(new Company());
        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.companies.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                        ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.companies.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                    <a href="' . route('admin-panel.companies.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                        ' . __('admin.delete') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_company($request , $id = null)
    {
        $data = [];
        $data['company_name'] = $request->company_name;
        $data['trade_name'] = $request->trade_name;
        $data['commercial_registration_number'] = $request->commercial_registration_number;
        $data['tax_number'] = $request->tax_number;
        $data['owner_name'] = $request->owner_name;
        $data['phone_number'] = $request->phone_number;
        $data['email'] = $request->email;
        //when only create
        if (!$id){
            $data['trial_ends_at'] = Carbon::now()->addDays(14);
        }

        if ($request->hasFile('file_commercial')) {
            $fileCommercial = $request->file('file_commercial');
            $filenameCommercial = time() . '_' . $fileCommercial->getClientOriginalName();
            $filePathCommercial = $fileCommercial->storeAs('uploads', $filenameCommercial, 'public');
            $data['file_commercial'] = $filePathCommercial;
        }

        if ($request->hasFile('file_tax')) {
            $fileTax = $request->file('file_tax');
            $filenameTax = time() . '_' . $fileTax->getClientOriginalName();
            $filePathTax = $fileTax->storeAs('uploads', $filenameTax, 'public');
            $data['file_tax'] = $filePathTax;
        }

        if ($request->password != null) {
            $data['password']   = Hash::make($request->password);
        }

        $editCompany = auth()->guard('company')->user();

        if ($editCompany) {
            $data['status'] = $editCompany->status;
        } else {
            $data['status'] = CompanyStatus::Active;
        }

        $company = $this->save(model: new Company() ,data: $data ,id: $id );
        if (!$company->hasRole('admin_company')) {
            $company->assignRole('admin_company');
        }
        return $company;
    }
}
