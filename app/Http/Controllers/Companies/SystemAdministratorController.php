<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Brand;
use App\Models\Item;
use App\Services\TermsService;
use App\Traits\Crud;
use Illuminate\Http\Request;

class SystemAdministratorController extends Controller
{
    use Crud;
    public function index()
    {
        $data = [];
        $companyID = auth()->guard('company')->user()->id;
        $data['administrators'] = Administrator::where('company_id' , $companyID)->get();
        return view('companies.setting.administrator.index' , $data);
    }

    public function addNewAdministrator()
    {
        return view('companies.setting.administrator.add');
    }

    public function save_administrator(Request $request)
    {
        $companyID = auth()->guard('company')->user()->id;
        if (!$request->administrator_name){
            return redirect()->back()->with('error', 'you must add new branch');
        }
        foreach ($request->administrator_name as $administrator){
            Administrator::create(['company_id'=>$companyID , 'administrator_name' => $administrator]);
        }
        return redirect()->route('companies.setting.administrator')->with('success', __('messages.success_msg'));
    }

    public function edit_administrator($id)
    {
        $data = [];
        $data['administrator'] = $this->getOneObject(new Administrator() , 'id' , $id);
        return view('companies.setting.administrator.edit' , $data);
    }

    public function update(Request $request , $id)
    {
        if (!$request->administrator_name){
            return redirect()->back()->with('error', 'you must add new branch');
        }
        $object = $this->getOneObject(new Administrator() , 'id' , $id)->update(['administrator_name'=>$request->administrator_name]);

        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->route('companies.setting.administrator')->with('success', __('messages.success_msg'));
    }

    public function delete_administrator($id)
    {
        $administrator = Administrator::find($id);

        if ($administrator) {
            $administrator->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Branch not found'], 404);
    }

}
