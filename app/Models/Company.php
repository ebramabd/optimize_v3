<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Spatie\Permission\Traits\HasRoles;

class Company extends Model implements Authenticatable
{
    use HasFactory  , AuthenticatableTrait , HasRoles;

    protected $fillable = [
       'company_name','trade_name','commercial_registration_number',
       'tax_number','owner_name','phone_number','email','password','status',
       'file_commercial','file_tax','profile_picture','trial_ends_at'
    ];

    protected $guard_name = 'company';
}
