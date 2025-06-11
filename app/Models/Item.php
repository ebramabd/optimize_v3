<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id' , 'item_name'];

    public static function get_brand_name($item_id = null)
    {
        if ($item_id){
            return DB::table('items')
                ->where('items.id' , $item_id)
                ->join('brands' , 'items.brand_id' , '=' , 'brands.id')
                ->first([
                    'items.id','brands.brand_name','items.item_name'
                ]);
        }

        return DB::table('items')
            ->join('brands' , 'items.brand_id' , '=' , 'brands.id')
            ->get([
                'items.id','brands.brand_name','items.item_name'
            ]);
    }

    public static function get_filter_items_with_service($service_ids)
    {
        $ids = \App\Models\BrandService::whereIn('service_id', $service_ids)
            ->pluck('item_id') // collection of JSON strings
            ->flatMap(function ($item) {
                return json_decode($item, true) ?: []; // decode each JSON string to array
            })
            ->unique()
            ->values()
            ->toArray();

        return \App\Models\Item::whereIn('id', $ids)->get();
    }
}
