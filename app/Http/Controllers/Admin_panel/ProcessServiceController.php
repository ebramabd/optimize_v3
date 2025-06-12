<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Http\Requests\admin_panel\ProcessServiceRequest;
use App\Models\Administrator;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\CarImages;
use App\Models\Company;
use App\Models\ProcessServiceData;
use App\Models\ProcessServiceProduct;
use App\Models\Service;
use App\Models\User;
use App\Services\BrandService;
use App\Services\ProcessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessServiceController extends Controller
{
    protected $processService ;

    public function __construct(ProcessService $processService)
    {
        $this->processService = $processService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->processService->get_process($request->all());
        }
        return view('admin_panel.process_service.index');
    }

    public function save($id = null)
    {
        $data = [];
        //edit
        $data['object']= $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);

        $data['client'] = ProcessServiceData::get_client($id);
        $data['car'] = ProcessServiceData::get_car($id);
        $data['branch'] = ProcessServiceData::get_branch($id);
        $data['administrator'] = ProcessServiceData::get_administrator($id);


        //create
        $data['services'] = $this->processService->getAllObject(new Service());
        $data['items'] = Service::get_items();
        $data['companies'] = $this->processService->getAllObject(model: new Company());

        return view('admin_panel.process_service.save' , $data );
    }

    public function save_post(ProcessServiceRequest $request , $id = null)
    {
        $object = $this->processService->save_process($request , $id);

        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function get_administrators(Request $request)
    {
        $data = [];
        $data['administrators'] = Administrator::where('company_id', $request->company_id)->get();
        $data['branches'] = Branch::where('company_id', $request->company_id)->get();
        $data['services_company'] = $this->processService->get_select_services($request->company_id);
        return response()->json($data);
    }

    public function details($id)
    {
        $object= $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $data = [];
        $data['client'] = ProcessServiceData::get_client($id);
        $data['car'] = ProcessServiceData::get_car($id);
        $data['images'] = CarImages::where('car_id' , $object->car_id)->get();
        $data['administrator'] = ProcessServiceData::get_administrator($id);
        $data['branch'] = ProcessServiceData::get_branch($id);
        $data['services'] = ProcessServiceProduct::get_services($id);
        $data['application_area'] =json_decode($object->application_area);
        return view('admin_panel.process_service.details', $data);
    }

    public function delete($id)
    {
        try {
            // Delete related ProcessServiceProduct entries first
            ProcessServiceProduct::where('process_id', $id)->delete();

            $process = ProcessServiceData::find($id);

            if (!$process) {
                return redirect()->back()->with('error', __('messages.error_msg'));
            }

            // Delete the ProcessServiceData entry
            $process->delete();

            return redirect()->back()->with('success', __('messages.success_msg'));

        } catch (\Exception $e) {
            \Log::error("Error deleting process with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
    }

    public function get_brands(Request $request)
    {
        $brandsItems = \App\Models\BrandService::where('service_id', $request->service_id)
            ->join('brands', 'brand_services.brand_id', '=', 'brands.id')
            ->join('items', function ($join) {
                $join->whereRaw("FIND_IN_SET(items.id, REPLACE(REPLACE(REPLACE(brand_services.item_id, '[', ''), ']', ''), ' ', ''))");
            })
            ->select(
                'brands.id',
                'brands.brand_name',
                'brand_services.item_id',
                DB::raw('GROUP_CONCAT(items.item_name SEPARATOR ", ") as item_names'),
                DB::raw('GROUP_CONCAT(items.id SEPARATOR ", ") as item_ids')
            )
            ->groupBy('brands.id', 'brands.brand_name', 'brand_services.item_id')
            ->get();
        return response()->json($brandsItems);
    }

}
