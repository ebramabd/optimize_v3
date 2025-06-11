<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Item;
use App\Services\BranchService;
use App\Services\TermsService;
use App\Traits\Crud;
use Illuminate\Http\Request;

class CompanyBranchesController extends Controller
{
    use Crud;
/*
    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }*/

    public function index()
    {
        $data = [];
        $companyID = auth()->guard('company')->user()->id;
        $data['branches'] = Branch::where('company_id' , $companyID)->get();
        return view('companies.setting.branches.index' , $data);
    }

    public function addNewBranch()
    {
        return view('companies.setting.branches.add');
    }

    public function save_branch(Request $request)
    {
        $companyID = auth()->guard('company')->user()->id;
        if (!$request->branch_name){
            return redirect()->back()->with('error', 'you must add new branch');
        }
        foreach ($request->branch_name as $branch){
            Branch::create(['company_id'=>$companyID , 'branch_name' => $branch]);
        }
        return redirect()->route('companies.setting.company_branches')->with('success', __('messages.success_msg'));

    }

    public function edit_branch($id)
    {
        $data = [];
        $data['branch'] = $this->getOneObject(new Branch() , 'id' , $id);
        return view('companies.setting.branches.edit' , $data);
    }

    public function update(Request $request , $id)
    {
        if (!$request->branch_name){
            return redirect()->back()->with('error', 'you must add new branch');
        }
        $object = $this->getOneObject(new Branch() , 'id' , $id)->update(['branch_name'=>$request->branch_name]);

        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->route('companies.setting.company_branches')->with('success', __('messages.success_msg'));
    }

    public function delete_branch($id)
    {
        $branch = Branch::find($id);

        if ($branch) {
            $branch->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Branch not found'], 404);
    }

}


