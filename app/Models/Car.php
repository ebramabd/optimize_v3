<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','category',
        'color','year_of_manufacture',
        'plate_number','meter_reading','first_letter','second_letter','third_letter',
    ];
}
