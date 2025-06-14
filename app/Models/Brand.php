<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['brand_name'];

    public static function get_default_brands()
    {
        $service_ids = Service::whereNull('branch_id')->pluck('id');
        $ids = \App\Models\BrandService::whereIn('service_id', $service_ids)
            ->pluck('brand_id') // collection of JSON strings
            ->unique()
            ->values()
            ->toArray();

        return \App\Models\Brand::whereIn('id', $ids)->get();
    }

    public static function get_filter_brand_with_service($service_ids)
    {
        $ids = \App\Models\BrandService::whereIn('service_id', $service_ids)
            ->pluck('brand_id')
            ->toArray();
        return \App\Models\Brand::whereIn('id', $ids)->get();
    }
}
