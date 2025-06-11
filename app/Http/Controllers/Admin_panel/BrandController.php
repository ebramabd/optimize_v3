<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin_panel\BrandRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Service;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    protected $brandService ;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->brandService->get_brands($request->all());
        }
        return view('admin_panel.brands.index');
    }

    public function save($id = null)
    {
        $data = [];
        $data['object'] = $this->brandService->getOneObject(model: new Brand() , key: 'id' ,value: $id);
        return view('admin_panel.brands.save' , $data );
    }

    public function save_post(BrandRequest $request , $id = null)
    {
        $object = $this->brandService->save_brand($request , $id);
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function details($id)
    {
        $object = $this->brandService->getOneObject(model: new Brand() , key: 'id' ,value: $id);
        return view('admin_panel.brands.details', compact('object'));
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                // Delete related items
                Item::where('brand_id', $id)->delete();
                // Delete the brand
                Brand::where('id', $id)->delete();
            });

            return redirect()->back()->with('success', __('messages.success_msg'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
    }

}
