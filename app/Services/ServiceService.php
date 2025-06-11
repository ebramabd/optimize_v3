<?php

namespace App\Services;

use App\Models\BranchServices;
use App\Models\Brand;
use App\Models\BrandService;
use App\Models\Item;
use App\Models\Service;
use App\Traits\Crud;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ServiceService
{
    use Crud;

    public function get_services($data)
    {
        $model = $this->getAllObject(new Service());
        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.services.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                         ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.services.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                    <a href="' . route('admin-panel.services.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                        ' . __('admin.delete') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_service($request , $id = null)
    {
        $data = [];
        $data['service_name'] = $request->service_name;
        $data['branch_id'] = $request->branch_id;
        $service = $this->save(model: new Service() ,data: $data ,id: $id );

        if (isset($request->brands) && isset($request->products)) {
            if ($id != null) {
                BrandService::where('service_id', $id)->delete();
            }
            $results = [];
          /*  foreach ($request->brands as $brand) {
                $items = array_merge($items, Item::whereIn('id', $request->products)
                    ->where('brand_id', $brand)
                    ->get()
                    ->toArray());
            }
            foreach ($items as $item) {
                 BrandService::create([
                    'brand_id' => $item['brand_id'],
                    'item_id' => $item['id'],
                    'service_id' => $service->id
                ]);
            }*/
            foreach ($request->brands as $brandId) {
                $matchedProducts = DB::table('items')
                    ->where('brand_id', $brandId)
                    ->whereIn('items.id', $request->products)
                    ->pluck('items.id') // get just the product IDs
                    ->toArray();

                $results[] = [
                    'brand_id' => (int)$brandId,
                    'products' => $matchedProducts
                ];
            }
            $items = [];

            foreach ($results as $result){
                $items[] = BrandService::create([
                    'brand_id' => $result['brand_id'],
                    'item_id' => json_encode($result['products']) ,
                    'service_id' => $service->id
                ]);
            }

        }
        return $items;
    }

    public function service_company($request , $id = null)
    {
        $data = [];
        if ($id){
            $service = Service::find($id);
            if ($service->branch_id !== null){
                $data['service_name'] = $request->service_name;
            }
        }
        if (!$id){
            $data['branch_id'] = auth()->guard('company')->user()->id;
            $data['service_name'] = $request->service_name;
        }

        $service = $this->save(new Service() , $data , $id);
        $this->save_service_brands($request , $service->id);
        return $service;
    }

    public function save_service_brands($request, $service_id)
    {
        $brandIds = $request->brand_ids;
        $itemIds = $request->item_ids;



        $service_old = Service::find($service_id);
        $isFromBranch = $service_old->branch_id;

        // If not from branch, clone service and insert branch services once
        $newService = null;
        if (!$isFromBranch) {
            $newService = Service::create([
                'service_name' => $request->service_name,
                'branch_id' => auth()->guard('company')->user()->id,
            ]);

            BranchServices::create([
                'service_id' => $service_old->id,
                'branch_id' => auth()->guard('company')->user()->id,
            ]);

            // Clone old brand-service data to new service
            $existingBrandServices = BrandService::where('service_id', $service_id)->get();
            foreach ($existingBrandServices as $copyRow) {
                BrandService::create([
                    'brand_id' => $copyRow->brand_id,
                    'item_id' => $copyRow->item_id,
                    'service_id' => $newService->id
                ]);
            }
        }

        if (!$itemIds || !$brandIds) return;

        $mergedData = array_map(function ($brand, $items) {
            return [
                'brand' => $brand,
                'items' => is_string($items) ? explode('&&', $items) : $items
            ];
        }, $brandIds, $itemIds);

        foreach ($mergedData as $data) {
            // Handle brand
            $brand = is_numeric($data['brand'])
                ? Brand::find($data['brand'])
                : Brand::create(['brand_name' => $data['brand']]);

            if (!$brand) continue;

            $itemIdsToInsert = [];
            foreach ($data['items'] as $item) {
                $itemModel = is_numeric($item)
                    ? Item::find($item)
                    : Item::create(['brand_id' => $brand->id, 'item_name' => $item]);

                if ($itemModel) {
                    $itemIdsToInsert[] = $itemModel->id;
                }
            }

            $targetServiceId = $isFromBranch ? $service_id : $newService->id;

            $brandService = BrandService::firstOrCreate(
                ['brand_id' => $brand->id, 'service_id' => $targetServiceId],
                ['item_id' => json_encode([])]
            );

            $existingItems = json_decode($brandService->item_id ?? '[]', true);
            $mergedItems = array_unique(array_merge($existingItems, $itemIdsToInsert));

            $brandService->update([
                'item_id' => json_encode(array_values($mergedItems))
            ]);
        }
    }

    public function get_service_company()
    {
        $branchId = auth()->guard('company')->user()->id;
        $rawData = DB::table('brand_services')
            ->join('services', 'brand_services.service_id', '=', 'services.id')
            /*->where(function ($query) use ($branchId) {
                $query->where('services.branch_id', $branchId)

                    ->orWhereNull('services.branch_id');
            })*/
            ->where(function ($query) use ($branchId) {
                $query->where('services.branch_id', $branchId)
                    ->orWhere(function ($subQuery) use ($branchId) {
                        $subQuery->whereNull('services.branch_id')
                            ->whereNotExists(function ($existsQuery) use ($branchId) {
                                $existsQuery->select(DB::raw(1))
                                    ->from('branch_services')
                                    ->whereRaw('branch_services.service_id = services.id')
                                    ->where('branch_services.branch_id', $branchId);
                            });
                    });
            })
            ->select('brand_services.*', 'services.service_name')
            ->get();


        $groupedData = [];
        foreach ($rawData as $row) {
            if (!isset($groupedData[$row->service_id])) {
                $groupedData[$row->service_id] = [
                    'service_id' => $row->service_id,
                    'service_name' => $row->service_name,
                    'brands' => []
                ];
            }
            if (!isset($groupedData[$row->service_id]['brands'][$row->brand_id])) {
                $groupedData[$row->service_id]['brands'][$row->brand_id] = [
                    'brand_id' => $row->brand_id,
                    'items' => []
                ];
            }
            $items = json_decode($row->item_id, true); // Decode JSON as associative array

            $groupedData[$row->service_id]['brands'][$row->brand_id]['items'] = array_merge(
                $groupedData[$row->service_id]['brands'][$row->brand_id]['items'],
                $items
            );

        }
        foreach ($groupedData as &$service) {
            $service['brands'] = array_values($service['brands']);
        }

        return array_values($groupedData);
    }


}
