<?php

namespace App\Services;
use DB;
use App\Models\Brand;
use App\Models\Item;
use App\Models\OrderCosting;
use App\Traits\Crud;
use Yajra\DataTables\DataTables;

class ItemService
{
    use Crud;

    public function get_items($data)
    {
        $model = Item::get_brand_name();
        return $this->getTableData($model);
    }

    public function get_items_admin($data)
    {
        if (isset($data['filter']) && $data['filter'] === 'specific') {
            $model = Item::get_default_items();
        } else {
            $model = Item::get_brand_name(); // all items
        }
        return $this->getTableDataAdmin($model);
    }

    public function get_items_for_commpany($data)
    {
        $company = auth()->guard('company')->user();

        $model = DB::table('order_costings')
            ->select('companies.company_name', 'item_id', 'center_id','items.item_name', 'meters_used', 'brands.brand_name'
               ,'brands.id' , 'process_service_data.id', 'process_service_data.branch_id', 'order_costings.created_at', 'process_id')
            ->orderBy('item_id')
            ->join('items', 'items.id', '=', 'order_costings.item_id')
            ->join('brands', 'brands.id', '=', 'items.brand_id')
            ->join('process_service_data', 'process_service_data.id', '=', 'order_costings.process_id')
            ->join('companies', 'companies.id', '=', 'process_service_data.branch_id')
            ->where('companies.id', $company->id);

        if (isset($data['from_date'])) {
            $model = $model->whereDate('order_costings.created_at', '>=', $data['from_date']);
        }
        if (isset($data['to_date'])) {
            $model = $model->whereDate('order_costings.created_at', '<=', $data['to_date']);
        }
        if (isset($data['item_id'])) {
            $model = $model->where('item_id', $data['item_id']);
        }
        if (isset($data['center_id'])) {
            $model = $model->where('center_id', $data['center_id']);
        }
        if (isset($data['brand_id'])) {
            $model = $model->where('brand_id', $data['brand_id']);
        }
        if (isset($data['service_id'])) {
            $model = $model->where('order_costings.service_id', $data['service_id']);
        }

        $model = $model->get();

        return $this->getTableData($model);
    }

    protected function getTableDataAdmin($model)
    {
        return Datatables::of($model)
             ->addColumn('action', function ($row) {
                 return '
                    <a href="' . route('admin-panel.items.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                          ' . __('admin.view') . '
                     </a>
                     <a href="' . route('admin-panel.items.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                         ' . __('admin.edit') . '
                     </a>
                     <a href="' . route('admin-panel.items.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                         ' . __('admin.delete') . '
                     </a>
                 ';
             })
            ->rawColumns(['action'])

            ->make(true);
    }

    protected function getTableData($model)
    {
        $totalMetersUsed = $model->sum('meters_used');
        return Datatables::of($model)
            // ->addColumn('action', function ($row) {
            //     return '
            //        <a href="' . route('admin-panel.items.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
            //              ' . __('admin.view') . '
            //         </a>
            //         <a href="' . route('admin-panel.items.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
            //             ' . __('admin.edit') . '
            //         </a>
            //         <a href="' . route('admin-panel.items.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
            //             ' . __('admin.delete') . '
            //         </a>
            //     ';
            // })
            ->rawColumns(['action'])
            ->with('total_meters_used', $totalMetersUsed)
            ->make(true);
    }

    public function save_item($request , $id = null)
    {
        $data = [];
        $data['brand_id'] = $request->brand_id;
        $data['item_name'] = $request->item_name;
        $brand = $this->save(model: new Item() ,data: $data ,id: $id );
        return $brand;
    }
}
