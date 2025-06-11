<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Http\Requests\admin_panel\ItemRequest;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Service;
use App\Services\BrandService;
use App\Services\ItemService;
use App\Services\ProcessService;
use Illuminate\Http\Request;

class ItemControllerforCompany extends Controller
{
    protected $itemService ;
    protected $processService ;

    public function __construct(ItemService $itemService, ProcessService $processService)
    {
        $this->itemService = $itemService;
        $this->processService = $processService;
    }

    public function index(Request $request)
    {
        $company = auth()->guard('company')->user();

        $data = [];
        $data['items'] = Item::get_brand_name();
        $data['branches'] = Branch::where('company_id' , $company->id)->get();
        $data['brands'] = $this->get_specific_brand($company->id);
        $data['total_mater_used'] = $this->itemService->get_items_for_commpany($request->all());
        $data['services'] = $this->processService->get_select_services($company->id);
        $this->itemService->get_items_for_commpany($request->all());

        if ($request->ajax()) {
            return $this->itemService->get_items_for_commpany($request->all());
        }

        return view('companies.items.index', $data);
    }

    public function get_specific_brand($company)
    {
        $services = $this->processService->get_select_services($company);
        $brandIds = [];

        foreach ($services as $service) {
            $ids = \App\Models\BrandService::where('service_id', $service->id)
                ->pluck('brand_id')
                ->toArray();

            $brandIds = array_merge($brandIds, $ids);
        }
        $brandIds = array_unique($brandIds);
        return $brands = \App\Models\Brand::whereIn('id', $brandIds)->get();
    }

    public function get_items_by_brand(Request $request)
    {
        $brandId = $request->query('brand_id');// retrieve from query param
        if ($brandId){
            $products = Item::where('brand_id',$brandId)->get();
        }else{
            $products  = Item::get_brand_name();
        }

        return response()->json(['product' => $products]);
    }

    public function get_brands_by_service(Request $request)
    {
        $serviceId = $request->query('service_id');
        if ($serviceId){
            $ids = \App\Models\BrandService::where('service_id', $serviceId)
                ->pluck('brand_id')
                ->toArray();
            $brands = \App\Models\Brand::whereIn('id', $ids)->get();
        }else{
            $brands = $this->get_specific_brand(auth()->guard('company')->user()->id);
        }
        return response()->json(['brands' => $brands]);
    }
}
