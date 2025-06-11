<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessServiceProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'process_id', 'service_id', 'brand_id', 'items_id'
    ];

    public static function get_services($process_id)
    {
        $service_ids = self::where('process_id', $process_id)->pluck('service_id')->unique();
        $services = self::whereIn('service_id', $service_ids) ->where('process_id', $process_id)->get();
        $data = [];
        foreach ($services as $service) {
            $items = json_decode($service->items_id, true);

            $data[] = [
                'service_name' => Service::where('id', $service->service_id)->first(['service_name']),
                'brand_name'  => Brand::where('id', $service->brand_id)->first(['brand_name']),
                'items'        => Item::whereIn('id', is_array($items) ? $items : [])->get(['item_name'])
            ];
        }
        return $data;
    }

    public static function get_order_services($processId)
    {
        $services = DB::table('process_service_products')
            ->where('process_id', $processId)
            ->get()
            ->groupBy('service_id')
            ->map(function ($group) {
                return [
                    'service_id' => $group->first()->service_id,
                    'process_id' => $group->first()->process_id,
                    'brands' => $group->map(function ($item) {
                        return [
                            'brand_id' => $item->brand_id,
                            'items' => json_decode($item->items_id, true) ?? []
                        ];
                    })->values()->all(),
                    'created_at' => $group->first()->created_at,
                    'updated_at' => $group->first()->updated_at,
                ];
            })
            ->values();

        return $services;

    }

}
