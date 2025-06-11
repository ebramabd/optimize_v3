<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsOfAgreement extends Model
{
    use HasFactory;
    protected $fillable = ['branch_id' , 'condition_text', 'condition_text_ar'];
}
