<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImages extends Model
{
    use HasFactory;
    protected $fillable = ['car_id' , 'order_status', 'image'];
}
