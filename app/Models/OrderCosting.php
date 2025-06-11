<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCosting extends Model
{
    use HasFactory;
    protected $fillable = ['process_id' , 'service_id', 'item_id', 'cost' , 'serial_number', 'warranty_code', 'meters_used','app_area'];
}
