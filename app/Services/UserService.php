<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Crud;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserService
{
    use Crud;

    public function get_users($data)
    {
        $model = $this->getAllObject(new User());
        return $this->getTableData($model);
    }

    protected function getTableData($model)
    {
        return Datatables::of($model)
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin-panel.users.details', ['id' => $row->id]) . '" class="btn btn-success" onclick="return true;">
                       ' . __('admin.view') . '
                    </a>
                    <a href="' . route('admin-panel.users.save', ['id' => $row->id]) . '" class="btn btn-primary" onclick="return true;">
                        ' . __('admin.edit') . '
                    </a>
                    <a href="' . route('admin-panel.users.delete', ['id' => $row->id]) . '" class="btn btn-danger" onclick="return confirm(\'' . __('admin.delete_confirmation') . '\');">
                        ' . __('admin.delete') . '
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save_user($request , $id = null)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['type'] = $request->type;
        $data['branch_id'] = $request->branch_id;

        if ($request->password != null) {
            $data['password']   = Hash::make($request->password);
        }

        $user = $this->save(model: new User() ,data: $data ,id: $id );
        return $user;
    }
}
