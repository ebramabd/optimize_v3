<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['service_name', 'branch_id'];

    public static function get_brand($service_id)
    {
        return DB::table('brand_services')
            ->join('brands' ,'brand_services.brand_id' , '=' , 'brands.id')
            ->where('brand_services.service_id' ,$service_id )
            ->get([
                'brand_services.service_id as service_id',
                'brand_services.brand_id as brand_id',
                'brand_services.item_id as item_id',
                'brands.brand_name as brand'
            ]);
    }

    public static function get_items($service_id = null)
    {

        if ($service_id == null) {
            $data = [];
            $brands = Brand::get();
             foreach ($brands as $brand){
                 $item = Item::where('brand_id' ,$brand->id)->get(['id' , 'item_name']);
                 $data[] = [
                     'brands' => ['brand_name'=>$brand->brand_name , 'brand_id'=>$brand->id],
                     'items' => $item
                 ];
             }
           return $data;

        }

        $brands = self::get_brand($service_id);
        $data = [];
        foreach ($brands as $brand) {
            if (!isset($data[$brand->brand_id])) {
                $data[$brand->brand_id] = [
                    'brand_name' => $brand->brand,
                    'items' => []
                ];
            }
            $items = DB::table('items')
                ->where('id', $brand->item_id)
                ->where('brand_id', $brand->brand_id)
                ->get(['items.item_name', 'items.id as item_id']);
            foreach ($items as $item) {
                $data[$brand->brand_id]['items'][] = $item;
            }
        }

        return $data;
    }

    public static function get_filter_default_service($branchId)
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
}
