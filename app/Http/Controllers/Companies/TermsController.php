<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\BranchesTerms;
use App\Models\TermsOfAgreement;
use App\Services\TermsService;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    protected $termService ;

    public function __construct(TermsService $termService)
    {
        $this->termService = $termService;
    }

    public function get_default_terms()
    {
//        $data['terms'] =  $this->termService->get_default_terms();
//        $data['terms'] = TermsOfAgreement::whereNull('branch_id')->first();
        $branch_id = auth()->guard('company')->user()->id;
        $default_term = TermsOfAgreement::whereNull('branch_id')->first();
        $branch_term = TermsOfAgreement::where('branch_id', $branch_id)->first();

        $default = BranchesTerms::where(['branch_id'=>$branch_id , 'terms_id'=>$default_term->id])->first();

        if (!$default){
          $data['terms'] =  $default_term;
        }else{
            $data['terms'] = $branch_term;
        }


        return view('companies.setting.terms.terms' , $data);
    }

    public function add_condition()
    {
        return view('companies.setting.terms.add');
    }

    public function add_condition_post(Request $request)
    {
        $data = [];
        $data['branch_id'] = auth()->guard('company')->user()->id;
        $data['condition_text'] = $request->condition;
        $object = $this->termService->save(new TermsOfAgreement() , $data);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->route('companies.setting.terms')->with('success', __('messages.success_msg'));
    }

    public function edit_terms($id)
    {
        $object = $this->termService->getOneObject(new TermsOfAgreement() , 'id' ,$id);
        return view('companies.setting.terms.edit' ,compact('object'));
    }

    public function edit_post_terms(Request $request , $id)
    {
//        return $request;
        $condition = TermsOfAgreement::where('id', $id)->first();
        if ($condition->branch_id != null){
            $object =  $condition->update([
                'condition_text'=>$request->condition,
                'condition_text_ar'=>$request->condition_ar,
                ]);
            if ($object == null) {
                return redirect()->back()->with('error', __('messages.error_msg'));
            }
            return redirect()->route('companies.setting.terms')->with('success', __('messages.success_msg'));
        }

        $data = [];
        $data['branch_id'] = auth()->guard('company')->user()->id;
        $data['condition_text'] = $request->condition;
        $data['condition_text_ar'] = $request->condition_ar;
        $this->termService->save(new TermsOfAgreement() , $data);

        $object = BranchesTerms::create(['terms_id' =>$id , 'branch_id'=>$data['branch_id']]);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->route('companies.setting.terms')->with('success', __('messages.success_msg'));
    }


}
