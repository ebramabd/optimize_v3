<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\ServiceCompanyRequest;
use App\Models\BranchServices;
use App\Models\Brand;
use App\Models\BrandService;
use App\Models\Item;
use App\Models\Service;
use App\Services\ServiceService;
use App\Services\TermsService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $termService ;
    protected $serviceService ;

    public function __construct(TermsService $termService , ServiceService $serviceService)
    {
        $this->termService = $termService;
        $this->serviceService = $serviceService;
    }

    public function get_default_service()
    {
        $data = [];
        $data['services'] = $this->serviceService->get_service_company();
        return view('companies.setting.service.index' , $data);
    }

    public function addService()
    {
        $branchId = auth()->guard('company')->user()->id;
        $serviceIDs = Service::get_filter_default_service($branchId)->pluck('id');
        $brands = Brand::get_filter_brand_with_service($serviceIDs);
        $items  = Item::get_filter_items_with_service($serviceIDs);
        return view('companies.setting.service.add_service', compact('brands', 'items'));
    }

    public function add_post(ServiceCompanyRequest $request , $id = null)
    {
//        return $request;
        $object =  $this->serviceService->service_company($request  ,$id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->route('companies.setting.service')->with('success', __('messages.success_msg'));
    }

    public function edit($id)
    {
        $data = [];
        $data['services'] = BrandService::where('service_id' , $id)->get();
        $data['objectService'] = Service::where('id' , $id)->first();

        $branchId = auth()->guard('company')->user()->id;
        $serviceIDs = Service::get_filter_default_service($branchId)->pluck('id');
        $data['brands'] = Brand::get_filter_brand_with_service($serviceIDs);
        $data['items']   = Item::get_filter_items_with_service($serviceIDs);
        return view('companies.setting.service.edit_service', $data);
    }


    public function delete_items(Request $request)
    {
        $serviceOld = Service::find($request->id_service);

        if (!$serviceOld) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $isFromBranch = $serviceOld->branch_id;
        $targetServiceId = $serviceOld->id;

        // If service is not from branch, clone it and related BrandService data
        if (!$isFromBranch) {
            $newService = Service::create([
                'service_name' => $serviceOld->service_name,
                'branch_id' => auth()->guard('company')->user()->id,
            ]);

            BranchServices::create([
                'service_id' => $serviceOld->id,
                'branch_id' => auth()->guard('company')->user()->id,
            ]);

            // Copy all existing brand-service relations
            $existingBrandServices = BrandService::where('service_id', $serviceOld->id)->get();
            foreach ($existingBrandServices as $copyRow) {
                BrandService::create([
                    'brand_id' => $copyRow->brand_id,
                    'item_id' => $copyRow->item_id,
                    'service_id' => $newService->id
                ]);
            }

            $targetServiceId = $newService->id;
        }

        // Now proceed to update the brand-service
        $brandService = BrandService::where([
            'service_id' => $targetServiceId,
            'brand_id' => $request->id_brand
        ])->first();

        if (!$brandService) {
            return response()->json(['message' => 'Brand-Service link not found'], 404);
        }

        $itemIds = json_decode($brandService->item_id, true);
        $itemIds = array_filter($itemIds, function ($id) use ($request) {
            return $id != $request->id_items;
        });

        $brandService->update([
            'item_id' => json_encode(array_values($itemIds))
        ]);

        return response()->json([
            'message' => 'Item removed successfully',
            'updated_items' => array_values($itemIds)
        ]);
    }
    public function delete_brands(Request $request)
    {
        $serviceOld = Service::find($request->id_service);

        if (!$serviceOld) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $isFromBranch = $serviceOld->branch_id;
        $targetServiceId = $serviceOld->id;

        // If service is not from branch, clone it and its relations
        if (!$isFromBranch) {
            // Clone service for the current company branch
            $newService = Service::create([
                'service_name' => $serviceOld->service_name,
                'branch_id' => auth()->guard('company')->user()->id,
            ]);

            // Link new service to the company/branch
            BranchServices::create([
                'service_id' => $serviceOld->id,
                'branch_id' => auth()->guard('company')->user()->id,
            ]);

            // Copy all existing brand-service data to the new service
            $existingBrandServices = BrandService::where('service_id', $serviceOld->id)->get();
            foreach ($existingBrandServices as $copyRow) {
                BrandService::create([
                    'brand_id' => $copyRow->brand_id,
                    'item_id' => $copyRow->item_id,
                    'service_id' => $newService->id
                ]);
            }

            $targetServiceId = $newService->id;
        }

        // Now delete the brand-service from the branch-specific service
        $brandService = BrandService::where([
            'service_id' => $targetServiceId,
            'brand_id' => $request->id_brand
        ])->first();

        if (!$brandService) {
            return response()->json(['message' => 'Brand-Service link not found'], 404);
        }

        $brandService->delete();

        return response()->json([
            'message' => 'Brand removed successfully',
        ]);
    }



    public function delete_service($id)
    {
        $serviceOld = Service::where('id' , $id)->first();
        if ($serviceOld->branch_id == null){
            $deleted = BranchServices::create([
                'service_id'=>$serviceOld->id,
                'branch_id'=>auth()->guard('company')->user()->id
            ]);
        }else{
            $deleted = BrandService::where('service_id', $id)->delete();
            if ($deleted){
                $serviceOld->delete();
            }
        }

        if ($deleted) {
            return redirect()->back()->with('success', __('messages.success_msg'));
        } else {
            return redirect()->back()->with('error', 'No records were found to delete.');
        }
    }

}
