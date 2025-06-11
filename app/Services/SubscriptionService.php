<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use App\Traits\Crud;
use Yajra\DataTables\DataTables;

class SubscriptionService
{
    use Crud;

    public function get_subscriptions($data)
    {
        $model = $this->getAllObject(new Subscription());
        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.subscriptions.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                         ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.subscriptions.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                    <a href="' . route('admin-panel.subscriptions.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                        ' . __('admin.delete') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_subscription($request , $id = null)
    {
        $data = [];
        $data['title'] = $request->title;
        $data['title_ar'] = $request->title_ar;
        $data['period'] = $request->period;
        $data['price'] = $request->price;
        $data['description'] = json_encode($request->description);
        $data['description_ar'] = json_encode($request->description_ar);
        $brand = $this->save(model: new Subscription() ,data: $data ,id: $id );
        return $brand;
    }

    public function get_subscriptions_companies($data)
    {
        $model = CompanySubscription::get_subscriptions_companies();
        return $this->getTableData_companies($model);
    }

    protected function getTableData_companies($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.subscriptions.companies.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                         ' . __('admin.view') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
