<?php

namespace App\Services;

use App\Models\BranchesTerms;
use App\Models\Brand;
use App\Models\TermsOfAgreement;
use App\Traits\Crud;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TermsService
{
    use Crud;

    public function get_terms($data)
    {
        $model = DB::table('terms_of_agreements')
            ->leftJoin('companies', 'terms_of_agreements.branch_id', '=', 'companies.id')
            ->get([
                'terms_of_agreements.id' , 'companies.company_name' ,'terms_of_agreements.condition_text','terms_of_agreements.condition_text_ar'
            ]);

        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.terms.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                         ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.terms.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_terms($request , $id = null)
    {
        $data = [];
        $data['branch_id'] = $request->branch_id;
        $data['condition_text'] = $request->condition_text;
        $data['condition_text_ar'] = $request->condition_text_ar;
        $condition = $this->save(model: new TermsOfAgreement() ,data: $data ,id: $id );
        return $condition;
    }

    public function get_default_terms()
    {

        /*    $branch_id = auth()->guard('company')->user()->id;

               $default_terms = TermsOfAgreement::whereNull('branch_id')->first();
               $branches_terms = TermsOfAgreement::where('branch_id', $branch_id)->first();

               $filtered_defaults = $default_terms->filter(function ($condition) use ($branch_id) {
                   return !BranchesTerms::where([
                       'terms_id' => $condition->id,
                       'branch_id' => $branch_id
                   ])->exists();
               });

               // Merge both collections
               $all_terms = $default_terms->merge($branches_terms);

               return $all_terms;*/
    }

}

/*<a href="' . route('admin-panel.terms.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
    ' . __('admin.delete') . '
</a>*/
