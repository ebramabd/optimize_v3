<?php

namespace App\Http\Controllers\Companies;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Branch;
use App\Models\BranchServices;
use App\Models\Brand;
use App\Models\BrandService;
use App\Models\Car;
use App\Models\CarImages;
use App\Models\Company;
use App\Models\Item;
use App\Models\OrderCosting;
use App\Models\ProcessServiceData;
use App\Models\ProcessServiceProduct;
use App\Models\Service;
use App\Models\TermsOfAgreement;
use App\Models\User;
use App\Services\MessageService;
use App\Services\ProcessService;
use App\Services\TermsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Str;

class   WorkStagesController extends Controller
{
    protected MessageService $messageService;
    protected $processService;

    public function __construct(ProcessService $processService, MessageService $messageService)
    {
        $this->processService = $processService;
        $this->messageService = $messageService;

    }

    public function test()
    {
        $this->processService->save_footer_image();
    }

    public function index()
    {
        $data = [];
        $data['orders'] = ProcessServiceData::get_orders_pending();
//        Wdd($data);
        return view('companies.work_stages.pending', $data);
    }

    public function showCompleted()
    {
        $data = [];
        $data['orders'] = ProcessServiceData::get_orders_completed();
        return view('companies.work_stages.completed' , $data);
    }

    public function showPrintCompleted($id)
    {
        $object = $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $data =[];
        $data['id'] = $id;
        $data['start_signature'] = $object->signature_path;
        $data['end_signature'] = $object->signature_completed;
        $data['footer_image'] = $object->footer_image;
        $data['orderID'] = $object->order_id;
        $data['created_at'] = $object->created_at;
        $data['branch_name'] = Branch::where('id', $object->center_id)->first()->branch_name;
        $data['client'] = User::where('id' ,$object->client_id)->first();
        $data['car'] = Car::where('id' ,$object->car_id)->first();
        $data['images'] = CarImages::where('car_id' ,$object->car_id)->get();
        $data['services'] = ProcessServiceProduct::get_order_services($id);
        $data['administrator'] = Administrator::where('id' ,$object->administrator)->first();
        $data['order_costing'] = $this->get_order_costing($object->id);
        $data['costingService'] = $this->get_costing($object->id);
        $data['company']       = Company::where('id', auth()->guard('company')->user()->id)->first();

        $terms =  TermsOfAgreement::where('branch_id' , auth()->guard('company')->user()->id)->first();
        if ($terms){
            $data['terms_ar'] = $terms->condition_text_ar;
            $data['terms_en'] = $terms->condition_text;
        }else{
            $data['terms_ar'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text_ar ;
            $data['terms_en'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text;
        }
        // dd($data);
        return view('companies.work_stages.print_completed' ,$data);
    }

    public function showUnderProcess($id)
    {
        $object = $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $data =[];
        $data['id'] = $id;
        $data['signature'] = $object->signature_path;
        $data['footer_image'] = $object->footer_image;
        $data['client'] = User::where('id' ,$object->client_id)->first();
        $data['car'] = Car::where('id' ,$object->car_id)->first();
        $data['images'] = CarImages::where('car_id' ,$object->car_id)->get();
        $data['services'] = ProcessServiceProduct::get_order_services($id);
        $data['administrator'] = Administrator::where('id' ,$object->administrator)->first();
        $data['branch_name'] = Branch::where('id' ,$object->center_id)->first();
        $data['selectServices'] = $this->get_select_services();
        $data['order_costing'] = $this->get_order_costing($object->id);
        $data['costingService'] = $this->get_costing($object->id);

        //for pdf
        $data['company']       = Company::where('id', auth()->guard('company')->user()->id)->first();
        $data['created_at'] = $object->created_at;
        $data['orderID'] = $object->order_id;
        $terms =  TermsOfAgreement::where('branch_id' , auth()->guard('company')->user()->id)->first();
        if ($terms){
            $data['terms_ar'] = $terms->condition_text_ar;
            $data['terms_en'] = $terms->condition_text;
        }else{
            $data['terms_ar'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text_ar ;
            $data['terms_en'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text;
        }
        return view('companies.work_stages.under_process' ,$data);
    }

    public function get_select_services()
    {
        $branchId = auth()->guard('company')->user()->id;
        $serviceCompany = Service::where('branch_id' , $branchId)->get();
        $serviceDefault = Service::whereNull('branch_id')->get();
        $getOnlyShow = [];
        foreach ($serviceDefault as $row){
            $existing = BranchServices::where(['branch_id'=>$branchId , 'service_id'=>$row->id])->first();
            if (!$existing){
                $getOnlyShow[] = $row ;
            }
        }
        $getOnlyShowCollection = collect($getOnlyShow);

        $mergedServices = $serviceCompany->merge($getOnlyShowCollection);

        return $mergedServices;
    }

    public function get_brands(Request $request)
    {
        $brandsItems = BrandService::where('service_id', $request->service_id)
            ->join('brands', 'brand_services.brand_id', '=', 'brands.id')
            ->join('items', function ($join) {
                $join->whereRaw("FIND_IN_SET(items.id, REPLACE(REPLACE(REPLACE(brand_services.item_id, '[', ''), ']', ''), ' ', ''))");
            })
            ->select(
                'brands.id',
                'brands.brand_name',
                'brand_services.item_id',
                DB::raw('GROUP_CONCAT(items.item_name SEPARATOR ", ") as item_names'),
                DB::raw('GROUP_CONCAT(items.id SEPARATOR ", ") as item_ids')
            )
            ->groupBy('brands.id', 'brands.brand_name', 'brand_services.item_id')
            ->get();

        return response()->json($brandsItems);
    }

    public function showWaitingDelivery($id)
    {
        $object = $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $data =[];
        $data['id'] = $id;
        $data['signature'] = $object->signature_path;

        $data['client'] = User::where('id' ,$object->client_id)->first();
        $data['car'] = Car::where('id' ,$object->car_id)->first();
        $data['images'] = CarImages::where('car_id' ,$object->car_id)->get();
        $data['services'] = ProcessServiceProduct::get_order_services($id);
        $data['administrator'] = Administrator::where('id' ,$object->administrator)->first();
        $data['branch_name'] = Branch::where('id' ,$object->center_id)->first();

        $data['order_costing'] = $this->get_order_costing($object->id);
        $data['costingService'] = $this->get_costing($object->id);

        // FOR PDF
        $data['created_at'] = $object->created_at;
        $data['footer_image'] = $object->footer_image;
        $terms =  TermsOfAgreement::where('branch_id' , auth()->guard('company')->user()->id)->first();

        if ($terms){
            $data['terms_ar'] = $terms->condition_text_ar;
            $data['terms_en'] = $terms->condition_text;
        }else{
            $data['terms_ar'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text_ar ;
            $data['terms_en'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text;
        }
        return view('companies.work_stages.waiting_delivery', $data);
    }

    public function edit_order(Request $request , $id)
    {
        $this->processService->add_services($request , $id);
        $object = $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $this->processService->save_client($request , $object->client_id);
        $this->processService->save_car($request , $object->car_id);
        $this->processService->save_image_order($request , $object->car_id, 0);
        $this->processService->order_costing($request , $object->id);
        $signature_path = $this->processService->save_signature($request);
        if ($signature_path){
            $object->update([
                'signature_path'=>$signature_path,
                'footer_image'=>$this->processService->save_footer_image($signature_path)
            ]);

        }
        if ($object == null) {
            return redirect()->back()->with('error', __('messages.error_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function delete_image($id)
    {
        if ($id) {
            $image = CarImages::find($id);
            if ($image) {
                \Storage::delete('public/' . $image->image);
                $image->delete();
                return response()->json(true);
            }
        }
        return response()->json(false);
    }

    public function convert_to_delivery($id)
    {
        $processServiceData = ProcessServiceData::find($id);
        $client = User::where('id' , $processServiceData->client_id)->first();
        $company_name = Company::where('id',$processServiceData->branch_id)->first()->company_name;
        try {
            $check_res = $this->messageService->sendCarReady(
                recipientPhone: $client->phone,//"+201090645427"
                carOwnerName: $client->name,
                companyName: $company_name,
            );
        } catch (\Throwable $e) {
            // Log full details for debugging
            \Log::error('Service agreement sending failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'client_id' => $data['client']->id ?? null,
            ]);
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please check the data and try again.');
        }

        if ($id){
            $object = $processServiceData->update(['status'=>OrderStatus::Waiting_For_Delivery]);

            if ($object == null) {
                return redirect()->back()->with('error', 'this process not correct');
            }
            return redirect()->route('companies.work_stages')->with('success', 'this order convert to delivery.');
        }
        return redirect()->back()->with('error', 'this process not correct');
    }

    public function convert_to_completed(Request $request, $id)
    {
        try {
            $processServiceData = ProcessServiceData::find($id);
            if ($id) {
                if ($request->signature) {
                    $signature_path = $this->processService->save_signature($request);
                    if ($signature_path) {
                        $processServiceData->update(['signature_completed' => $signature_path]);
                    }
                }
                if ($request->images) {

                    $this->processService->save_image_order($request, $processServiceData->car_id,1);
                }
                $meters_used=$request->meters_used;
                $item_service_id=$request->item_service_id;
                foreach ($meters_used as $index => $value) {
                    $orderCosting = OrderCosting::where(['process_id' => $processServiceData->id, 'service_id' => $item_service_id[$index], 'item_id' => $index ])->first();

                    if ($orderCosting) {
                            $orderCosting->update([
                                'meters_used' => $value,
                            ]);
                        }
                }
                $object = $processServiceData->update(['status' => OrderStatus::Completed]);
                if ($object == null) {
                    return redirect()->back()->with('error', 'this process not correct');
                }

                $delivery_note = $this->send_delivery_note($id);
                if (!$delivery_note){
                    return $delivery_note;
                }

                return redirect()->route('companies.work_stages.completed')->with('success', 'this order convert to completed.');
            }
        } catch (\Exception $e) {
        }
        return redirect()->back()->with('error', 'this process not correct');
    }

    public function send_delivery_note($id)
    {
        $object = ProcessServiceData::find($id);
        $data =[];
        $data['id'] = $id;
        $data['signature'] = $object->signature_path;
        $data['signature_completed'] = $object->signature_completed;

        $data['client'] = User::where('id' ,$object->client_id)->first();
        $data['car'] = Car::where('id' ,$object->car_id)->first();
        $data['images'] = CarImages::where('car_id' ,$object->car_id)->get();
        $data['services'] = ProcessServiceProduct::get_order_services($id);
        $data['administrator'] = Administrator::where('id' ,$object->administrator)->first();
        $data['branch_name'] = Branch::where('id' ,$object->center_id)->first();


        $html = view('companies.work_stages.delivery_note', $data)->render();
        $pdf = SnappyPdf::loadHTML($html);

        $filename = 'pdf_' . uniqid() . '.pdf';
        $hashedFileName = Str::random(length: 20) . '.pdf';
        //$savePath = public_path('media/'.$id.'/delivery_note.pdf');
        $savePath = public_path('media/' .$id. '/' . $hashedFileName);
	$pdf->save($savePath);

        $client = User::where('id' , $object->client_id)->first();
        $company_name = Company::where('id',$object->branch_id)->first()->company_name;
        try {
            $check_res = $this->messageService->sendDeliveryNote(
                recipientPhone: $client->phone,
                carOwnerName: $client->name,
                companyName: $company_name,
                //mediaUrl: 'media/'.$id.'/delivery_note.pdf',
		mediaUrl: 'media/'. $id. '/' . $hashedFileName
            );


        } catch (\Throwable $e) {
            // Log full details for debugging
            \Log::error('Service agreement sending failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'client_id' => $data['client']->id ?? null,
            ]);

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please check the data and try again.');
        }

        return $pdf->inline('delivery note ');
    }

    public function get_order_costing($process_id)
    {
        return DB::table('order_costings')
            ->join('services' , 'order_costings.service_id' , '=' ,'services.id')
            ->where('order_costings.process_id',$process_id)
            ->get();
    }

    public function get_costing($process_id)
    {
        $costings = DB::table('order_costings')
            ->join('services', 'order_costings.service_id', '=', 'services.id')
            ->where('order_costings.process_id', $process_id)
            ->groupBy('order_costings.service_id', 'services.service_name')
            ->select(
                'order_costings.service_id',
                'services.service_name',
                DB::raw('MIN(order_costings.cost) as cost')
            )
            ->get();

        return $costings ?? collect(); // if null/false, return empty collection
    }

    public function downloadAgreement($id)
    {
        /*$snappy = App::make('snappy.pdf.wrapper');
        $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
        $snappy->generateFromHtml($html, 'example_1.pdf');*/

        $object                = $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $data                  = [];
        $data['id']            = $id;
        $data['signature']     = $object->signature_path;
        $data['client']        = User::where('id' ,$object->client_id)->first();
        $data['car']           = Car::where('id' ,$object->car_id)->first();
        $data['images']        = CarImages::where('car_id' ,$object->car_id)->get();
        $data['services']      = ProcessServiceProduct::get_order_services($id);
        $data['administrator'] = Administrator::where('id' ,$object->administrator)->first();
        $data['company']       = Company::where('id', auth()->guard('company')->user()->id)->first();
        $data['order_costing'] = $this->get_order_costing($object->id);

        return view('companies.work_stages.download_pdf', $data);
    }

    public function send_service_agreement($id)
    {
        $object = $this->processService->getOneObject(new ProcessServiceData() , 'id' , $id);
        $data =[];
        $data['id'] = $id;
        $data['signature'] = $object->signature_path;

        $data['client'] = User::where('id' ,$object->client_id)->first();
        $data['car'] = Car::where('id' ,$object->car_id)->first();
        $data['images'] = CarImages::where('car_id' ,$object->car_id)->get();
        $data['services'] = ProcessServiceProduct::get_order_services($id);
        $data['administrator'] = Administrator::where('id' ,$object->administrator)->first();
        $data['branch_name'] = Branch::where('id' ,$object->center_id)->first();

        $data['order_costing'] = $this->get_order_costing($object->id);
        $data['costingService'] = $this->get_costing($object->id);
        $data['orderID'] = $object->order_id;
        $data['company']       = Company::where('id', auth()->guard('company')->user()->id)->first();

        // FOR PDF
        $data['created_at'] = $object->created_at;
        $data['footer_image'] = $object->footer_image;
        $terms =  TermsOfAgreement::where('branch_id' , auth()->guard('company')->user()->id)->first();

        if ($terms){
            $data['terms_ar'] = $terms->condition_text_ar;
            $data['terms_en'] = $terms->condition_text;
        }else{
            $data['terms_ar'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text_ar ;
            $data['terms_en'] = TermsOfAgreement::whereNull('branch_id')->first()->condition_text;
        }


        $footerHtml = view()->make('companies.work_stages.footer_pdf',  ['signature' => $data['signature']])->render();

        $pdf = SnappyPdf::loadView('companies.work_stages.download_pdf', $data);


        $pdf->setOptions([
            'footer-html' => $footerHtml,
            'margin-bottom' => '60mm',
            'orientation' => 'portrait',
            'page-size' => 'A4',
            'enable-local-file-access' => true,
        ]);
        $hashedFileName = Str::random(20) . '.pdf';
        //$savePath = public_path('media/'.$id.'/agreement.pdf');
        $savePath = public_path('media/' .$id. '/' . $hashedFileName);

	if (!file_exists($savePath)) {
            $pdf->save($savePath);
        }
        try {
            $check_res = $this->messageService->sendServiceAgreement(
                recipientPhone: $data['client']->phone,
                carOwnerName: $data['client']->name,
                companyName: $data['company']->company_name,
//                mediaUrl: 'media/'.$id.'/agreement.pdf',
                mediaUrl: 'media/'. $id. '/' . $hashedFileName,
            );
            if (isset($check_res['success']) && $check_res['success'] === true) {
                return redirect()->back()->with('success', 'The agreement was sent successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to send the agreement. Please try again.');
            }
        } catch (\Throwable $e) {
            // Log full details for debugging
            \Log::error('Service agreement sending failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'client_id' => $data['client']->id ?? null,
            ]);

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please check the data and try again.');
        }
    }


}
