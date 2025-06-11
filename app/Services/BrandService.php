<?php

namespace App\Services;

use App\Models\Brand;
use App\Traits\Crud;
use Yajra\DataTables\DataTables;

class BrandService
{
    use Crud;

    public function get_brands($data)
    {
        $model = $this->getAllObject(new Brand());
        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.brands.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                         ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.brands.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                    <a href="' . route('admin-panel.brands.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                        ' . __('admin.delete') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_brand($request , $id = null)
    {
        $data = [];
        $data['brand_name'] = $request->brand_name;
        $brand = $this->save(model: new Brand() ,data: $data ,id: $id );
        return $brand;
    }
}
