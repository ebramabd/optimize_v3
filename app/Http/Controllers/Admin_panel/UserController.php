<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\UserRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService ;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->userService->get_users($request->all());
        }
        return view('admin_panel.users.index');
    }

    public function save($id = null)
    {
        $data = [];

        $data['object'] = $this->userService->getOneObject(model: new User() , key: 'id' ,value: $id);
        $data['branches'] = $this->userService->getAllObject(new Company());
        return view('admin_panel.users.save' , $data);
    }

    public function save_post(UserRequest $request , $id = null)
    {
//        return $request;
        $object = $this->userService->save_user($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $object = $this->userService->getOneObject(model: new User() , key: 'id' ,value: $id);
        return view('admin_panel.users.details', compact('object'));
    }

    public function delete($id)
    {
        $object = $this->userService->delete(model: new User() ,id: $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}
