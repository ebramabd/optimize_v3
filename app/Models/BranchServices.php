<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchServices extends Model
{
    use HasFactory;
    protected $fillable = ['service_id' , 'branch_id', 'not_show'];
}
