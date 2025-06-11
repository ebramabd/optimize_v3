<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandService extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id', 'item_id', 'service_id'];
}
