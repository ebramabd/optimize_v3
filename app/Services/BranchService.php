<?php

namespace App\Services;

use App\Models\Brand;
use App\Traits\Crud;
use Yajra\DataTables\DataTables;

class BranchService
{
    use Crud;

    public function get_branches($data)
    {
        $model = $this->getAllObject(new Brand());
//        return $this->getTableData($model);
    }


    public function save_branch($request , $id = null)
    {
        $data = [];
        $data['brand_name'] = $request->brand_name;
        $brand = $this->save(model: new Brand() ,data: $data ,id: $id );
        return $brand;
    }
}
