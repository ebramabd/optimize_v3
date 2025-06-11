<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Http\Requests\admin_panel\ItemRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Services\BrandService;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService ;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->itemService->get_items_admin($request->all());
        }
        return view('admin_panel.items.index');
    }

    public function save($id = null)
    {
        $data = [];
        $data['object'] = $this->itemService->getOneObject(model: new Item() , key: 'id' ,value: $id);
        $data['brands'] = $this->itemService->getAllObject(new Brand());
        return view('admin_panel.items.save' , $data);
    }

    public function save_post(ItemRequest $request , $id = null)
    {
        $object = $this->itemService->save_item($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $object = Item::get_brand_name($id);
        return view('admin_panel.items.details', compact('object'));
    }

    public function delete($id)
    {
        $object = $this->itemService->delete(model: new Item() ,id: $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}
