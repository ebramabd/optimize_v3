<?php

namespace App\Services;

use App\Enums\UserType;
use App\Models\BranchServices;
use App\Models\Car;
use App\Models\CarImages;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Models\OrderCosting;
use App\Models\ProcessServiceData;
use App\Models\ProcessServiceProduct;
use App\Models\User;
use App\Traits\Crud;
use Illuminate\Support\Facades\DB;
use Imagick;
use Yajra\DataTables\DataTables;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProcessService
{
    use Crud;

    public function get_process($data)
    {
        $model = ProcessServiceData::index_page();
        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.process-service.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                         ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.process-service.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                    <a href="' . route('admin-panel.process-service.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                        ' . __('admin.delete') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function save_process($request, $id = null)
    {
        DB::beginTransaction();

        try {
            $data['client_id'] = $this->save_client($request, $request->client_edit);
            $data['car_id'] = $this->save_car($request, $request->car_edit);
            $this->save_image_order($request, $data['car_id'],0);
            $data['administrator'] = $request->administrator;
            if (auth()->user()){
                $data['branch_id'] = $request->company_id;
            }
            if (auth()->guard('company')->user()){
                $data['branch_id'] = auth()->guard('company')->user()->id;
            }
            $data['center_id'] = $request->center_id;
            $data['application_area'] = json_encode($request->application_area);
            $data['signature_path'] = $this->save_signature($request);
            $data['footer_image'] = $this->save_footer_image($data['signature_path']);

            $process = $this->save(new ProcessServiceData(), $data, $id);

            $this->add_services($request, $process->id);
            $this->order_costing($request, $process->id);

            DB::commit();

            return $process;
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error in save_process: ' . $e->getMessage());

            return null;
        }
    }



    public function save_signature($request)
    {

        $signatureData = $request->input('signature');
        if (!$signatureData) return null;

        $image = str_replace('data:image/png;base64,', '', $signatureData);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        $fileName = 'signature_' . Str::random(10) . '.png';

        $tmpFilePath = sys_get_temp_dir() . '/' . $fileName;
        file_put_contents($tmpFilePath, $imageData);

        $filePath = Storage::disk('public')->putFileAs('signatures', new File($tmpFilePath), $fileName);
        return $filePath;

    }

    public function save_footer_image($path_sign)
    {
//        $path_sign = storage_path('app/public/signatures/signature_0HqUoJeboZ.png');


        if (!$path_sign){
            return null;
        }
//        dd($path_sign);

        // 1. Create and resize the sign image
        $signPath = storage_path('app/public/' . $path_sign);
//        $signPath = storage_path('app/public/signatures/signature_0HqUoJeboZ.png');

        $img_sign = new \Imagick($signPath);
        $img_sign->scaleImage(300, 45);
        $img_sign->writeImage($signPath);


        // 2. Create GD image instances
        $filePath = public_path('assets/imgs/footer_main.png');




        $dest = imagecreatefrompng($filePath);
        $src = imagecreatefrompng($signPath);

         // empty

        // 3. Merge images
        imagecopymerge($dest, $src, 145, 85, 0, 0, 300, 45, 75);

        // 4. Save the final image temporarily
        $finalImagePath = storage_path('app/public/footer_' . time() . '.png');
        imagepng($dest, $finalImagePath);

        // 5. Get the relative path to store in DB
        $relativePath = str_replace(storage_path('app/public/'), '', $finalImagePath);


       return $relativePath;

    }

    public function save_client($request , $client_id)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['type'] = UserType::Client;
        $client = $this->save(model: new User() ,data: $data , id: $client_id);
        return $client->id;
    }

    public function save_car($request , $car_id)
    {
        $data = [];
        $data['type'] = $request->type;
        $data['category'] = $request->category;
        $data['color'] = $request->color;
        $data['year_of_manufacture'] = $request->year_of_manufacture;
        $data['plate_number'] =$request->plate_number;
        $data['first_letter'] =$request->first_letter;
        $data['second_letter'] =$request->second_letter;
        $data['third_letter'] =$request->third_letter;
        $data['meter_reading'] =$request->meter_reading;
        $car = $this->save(model: new Car() ,data: $data , id: $car_id);
        return $car->id;
    }




    public function save_image($request , $car_id,$order_status)
    {
        if ($request->hasFile('images')) {
            $filePaths = [];
            foreach ($request->file('images') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                 $filePath = $file->storeAs('uploads', $fileName, 'public');
                $filePaths[] = $filePath;
            }
            foreach ($filePaths as $path){
                CarImages::create(['car_id'=> $car_id ,'order_status'=>$order_status, 'image'=>$path]);
            }
        }
    }

    public function save_image_order($request, $car_id, $order_status)
    {
        $base64Images = json_decode($request->input('images'), true);

        if (is_array($base64Images)) {
            foreach ($base64Images as $base64) {
                // Get mime type and base64 data
                if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                    $image = substr($base64, strpos($base64, ',') + 1);
                    $image = base64_decode($image);

                    $extension = strtolower($type[1]); // jpg, png, etc.
                    $fileName = time() . '_' . Str::random(10) . '.' . $extension;
                    $filePath = 'uploads/' . $fileName;

                    Storage::disk('public')->put($filePath, $image);

                    CarImages::create([
                        'car_id' => $car_id,
                        'order_status' => $order_status,
                        'image' => $filePath
                    ]);
                }
            }
        }
    }



    public function add_services($request, $process_id)
    {
        $servicesData = $this->get_edit_services($request)['services'] ?? [];

        foreach ($servicesData as $service) {
            $serviceId = $service['service_id'];

            foreach ($service['brands'] as $brand) {
                $brandId = $brand['brand_id'];
                $items_ids = $brand['items'];

                // Check if entry exists
                $existingRecord = ProcessServiceProduct::where([
                    'process_id' => $process_id,
                    'service_id' => $serviceId,
                    'brand_id' => $brandId
                ])->first();

                if ($existingRecord) {
                    // Update existing
                    $existingRecord->update([
                        'items_id' => json_encode($items_ids)
                    ]);
                } else {
                    // Create new
                    ProcessServiceProduct::create([
                        'process_id' => $process_id,
                        'service_id' => $serviceId,
                        'brand_id' => $brandId,
                        'items_id' => json_encode($items_ids)
                    ]);
                }
            }
        }
    }


    public function get_edit_services($request)
    {
         $services = $request->input('services');

        if (empty($services)) {
            return [];
        }

        $filteredServices = [];

        foreach ($services as $service) {
            $serviceId = $service['service_id'];
            $filteredBrands = [];

            foreach ($service['brands'] as $brand) {
                $brandId = $brand['brand_id'];
                $submittedItemIds = $brand['items'];

//                $validItemIds = DB::table('items')
//                    ->where('brand_id', $brandId)
//                    ->pluck('id')
//                    ->toArray();
                $jasonItemIds = DB::table('brand_services')->where(['brand_id'=>$brandId, 'service_id'=>$serviceId])->first()->item_id;
                $validItemIds = json_decode($jasonItemIds);

                $filteredItems = array_filter($submittedItemIds, function ($itemId) use ($validItemIds) {
                    return in_array($itemId, $validItemIds);
                });

                if (!empty($filteredItems)) {
                    $filteredBrands[] = [
                        'brand_id' => $brandId,
                        'items' => array_values($filteredItems)
                    ];
                }
            }

            if (!empty($filteredBrands)) {
                $filteredServices[] = [
                    'service_id' => $serviceId,
                    'brands' => $filteredBrands
                ];
            }
        }
        return ['services' => $filteredServices];
    }

    public function order_costing($request , $processID)
    {
        $service_ids = $request->service_id;
        $items_ids = $request->item_ids;
        $costs = $request->cost;
        $serial_number = $request->serial_number;
        $warranty_code = $request->warranty_code;
        $app_area = $request->app_area;

        if(!$costs){
            return null;
        }

        $merged = [];
        foreach ($service_ids as $index => $service_id) {
            $combinedItemIds = $items_ids[$index] ?? null;

            $itemIdsArray = explode('&&', $combinedItemIds);

            foreach ($itemIdsArray as $item_id) {
                $merged[] = [
                    'service_id' => $service_id,
                    'item_id' => $item_id,
                    'cost' => $costs[$index] ?? null,
                    'serial_number' => $serial_number[$index] ?? null,
                    'warranty_code' => $warranty_code[$index] ?? null,
                    'app_area' => $app_area[$index] ?? null,
                ];
            }
        }


        foreach ($merged as $row){
            $orderCosting = OrderCosting::query()
                ->where('process_id', $processID)
                ->where('service_id', $row['service_id'])
                ->where('item_id', $row['item_id'])
                ->first();

            if ($orderCosting){
                $orderCosting->update([
                    'cost' => $row['cost'],
                    'serial_number' => $row['serial_number'],
                    'warranty_code' => $row['warranty_code'],
                    'app_area' => json_encode(array_map('trim', explode(',', $row['app_area'] ?? ''))),
                ]);
            }else{
                OrderCosting::create([
                    'process_id' => $processID,
                    'service_id'=>$row['service_id'],
                    'item_id'=>$row['item_id'],
                    'cost' => $row['cost'],
                    'serial_number'=>$row['serial_number'],
                    'warranty_code'=>$row['warranty_code'],
                    'app_area' => json_encode(array_map('trim', explode(',', $row['app_area'] ?? ''))),
                ]);
            }
        }
    }

    public function get_select_services($branchId)
    {
        $serviceCompany = Service::where('branch_id' , $branchId)->get();
        $serviceDefault = Service::whereNull('branch_id')->get();
        $getOnlyShow = [];
        foreach ($serviceDefault as $row){
            $existing = BranchServices::where(['branch_id'=>$branchId , 'service_id'=>$row->id])->first();
            if (!$existing){
                $getOnlyShow[] = $row ;
            }
        }
        $getOnlyShowCollection = collect($getOnlyShow);

        $mergedServices = $serviceCompany->merge($getOnlyShowCollection);

        return $mergedServices;
    }
    /*    public function save_process_products($request , $process_id)
        {
            $services = $request->input('services_ids');
            $brands = $request->input('brands_ids');
            $items = $request->input('items_ids');

            $insertData = [];

            foreach ($services as $index => $service) {
                $brandArray = explode(',', $brands[$index]);
                $itemsArray = explode(',', $items[$index]);

                foreach ($brandArray as $brand) {
                    $brandItems = DB::table('items')
                        ->where('brand_id', $brand)
                        ->whereIn('id', $itemsArray)
                        ->pluck('id')
                        ->toArray();

                    if (empty($brandItems)) {
                        continue;
                    }

                    $process[] =  ProcessServiceProduct::create([
                        'process_id' => $process_id,
                        'service_id' => $service,
                        'brand_id' => $brand,
                        'items_id' => json_encode($brandItems),
                    ]);

                }
            }
            return $process;
        }*/

}
