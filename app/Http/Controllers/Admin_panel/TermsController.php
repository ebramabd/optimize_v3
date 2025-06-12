<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Http\Requests\admin_panel\TermsRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Service;
use App\Models\TermsOfAgreement;
use App\Services\BrandService;
use App\Services\TermsService;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    protected $termService ;

    public function __construct(TermsService $termService)
    {
        $this->termService = $termService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->termService->get_terms($request->all());
        }

        return view('admin_panel.terms.index');
    }

    public function save($id = null)
    {
        $data = [];
        $data['object'] = $this->termService->getOneObject(model: new TermsOfAgreement() , key: 'id' ,value: $id);
        $data['branches'] = $this->termService->getAllObject(new Company());
        return view('admin_panel.terms.save' , $data );
    }

    public function save_post(TermsRequest $request , $id = null)
    {
        $object = $this->termService->save_terms($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $object = $this->termService->getOneObject(model: new TermsOfAgreement() , key: 'id' ,value: $id);
        return view('admin_panel.terms.details', compact('object'));
    }

    public function delete($id)
    {
        $object = $this->termService->delete(model: new TermsOfAgreement() ,id: $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}
