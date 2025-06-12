<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessServiceData extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id','center_id','administrator','client_id','car_id','application_area',
        'status', 'order_id', 'signature_path','signature_completed','footer_image'
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_id = self::generateUniqueOrderNumber();
        });
    }

    public static function generateUniqueOrderNumber()
    {
        do {
            $orderNumber = rand(1000, 9999); // Generate a random 4-digit number
        } while (self::where('order_id', $orderNumber)->exists());

        return $orderNumber;
    }

    public static function get_orders_home()
    {
        return DB::table('process_service_data')
            ->join('users', 'process_service_data.client_id', '=', 'users.id')
            ->where('status' , OrderStatus::Under_processing)
            ->where('process_service_data.branch_id', auth()->guard('company')->user()->id)
            ->orderBy('process_service_data.id', 'desc')
            ->limit(3)
            ->get([
                'process_service_data.id',
                'process_service_data.order_id',
                'process_service_data.created_at',
                'process_service_data.status',
                'users.name',
                'users.last_name',
                'users.email',
                'users.phone',
            ]);
    }

    public static function get_orders_pending()
    {
        return DB::table('process_service_data')
            ->join('users', 'process_service_data.client_id', '=', 'users.id')
//            ->join('administrators', 'process_service_data.client_id', '=', 'administrators.id')
            ->where('status', '!=', OrderStatus::Completed)
            ->where('process_service_data.branch_id', auth()->guard('company')->user()->id)
            ->orderBy('process_service_data.id', 'desc')
            ->get([
                'process_service_data.id',
                'process_service_data.order_id',
                'process_service_data.created_at',
                'process_service_data.status',
                'users.name',
                'users.last_name',
                'users.email',
                'users.phone',
            ]);
    }

    public static function get_orders_completed()
    {
        return DB::table('process_service_data')
            ->join('users', 'process_service_data.client_id', '=', 'users.id')
            ->where('status', OrderStatus::Completed)
            ->where('process_service_data.branch_id', auth()->guard('company')->user()->id)
            ->orderBy('process_service_data.id', 'desc')
            ->get([
                'process_service_data.id',
                'process_service_data.order_id',
                'process_service_data.created_at',
                'process_service_data.status',
                'users.name',
                'users.last_name',
                'users.email',
                'users.phone',
            ]);
    }


    public static function index_page()
    {
        return DB::table('process_service_data')
            ->join('cars', 'process_service_data.car_id' , '=' ,'cars.id')
            ->join('administrators' ,'process_service_data.administrator' , '=' ,'administrators.id')
            ->join('companies' ,'process_service_data.branch_id' , '=' ,'companies.id')
            ->get(
                ['process_service_data.id as id' , 'cars.type as type' , 'administrators.administrator_name as administrator' , 'company_name']
            );
    }
    public static function get_client($process_id)
    {
        return DB::table('process_service_data')
            ->join('users' ,'process_service_data.client_id' , '=' ,'users.id')
            ->where('process_service_data.id' , $process_id)
            ->first();
    }
    public static function get_car($process_id)
    {
        return DB::table('process_service_data')
            ->join('cars', 'process_service_data.car_id' , '=' ,'cars.id')
            ->where('process_service_data.id' , $process_id)
            ->first();
    }
    public static function get_administrator($process_id)
    {
        return DB::table('process_service_data')
            ->join('users' ,'process_service_data.administrator' , '=' ,'users.id')
            ->where('process_service_data.id' , $process_id)
            ->first();
    }
    public static function get_branch($process_id)
    {
        return DB::table('process_service_data')
            ->join('companies' ,'process_service_data.branch_id' , '=' ,'companies.id')
            ->where('process_service_data.id' , $process_id)
            ->first();
    }



}
