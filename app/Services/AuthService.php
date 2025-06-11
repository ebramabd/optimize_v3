<?php

namespace App\Services;

use App\Models\Company;
use App\Traits\Crud;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthService
{
    use Crud;

    public function getUniquePageKey(): string
    {
        $visitorId = Session::getId(); // Get the Laravel session ID
        $pageKey = md5($visitorId . Str::random(5) . time() . Str::random(5));
        return $pageKey;
    }

    public function checkCompany($request)
    {
        $company = Company::where('email' , $request->email)->first();
        if (!$company){
            return null;
        }
        if ($company->phone_number !== $request->phone_number){
            return null;
        }
        return $company->id;
    }

}
