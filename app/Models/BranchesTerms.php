<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchesTerms extends Model
{
    use HasFactory;
    protected $fillable = ['terms_id', 'branch_id', 'not_show'];
}
