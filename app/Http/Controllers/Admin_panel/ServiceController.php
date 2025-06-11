<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\ServiceRequest;
use App\Models\BrandService;
use App\Models\Company;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceService ;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->serviceService->get_services($request->all());
        }
        return view('admin_panel.services.index');
    }

    public function save($id = null)
    {
        $data = [];
        $data['items'] = Service::get_items();
        $data['branches'] = $this->serviceService->getAllObject(new Company());
        $data['object'] = $this->serviceService->getOneObject(model: new Service() , key: 'id' ,value: $id);
        return view('admin_panel.services.save' , $data );
    }

    public function save_post(ServiceRequest $request , $id = null)
    {
//        return $request;
        $object = $this->serviceService->save_service($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $data = [];
        $data['service'] =  $this->serviceService->getOneObject(new Service() , 'id' , $id);
//        $data['object'] = Service::get_items($id);
        $data['object'] = BrandService::where('service_id', $id)->get();
        return view('admin_panel.services.details', $data);
    }

    public function delete($id)
    {
        $object = $this->serviceService->delete(model: new Service() ,id: $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}
