<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\StoritevToOrder;
use App\Services\EmailCreateService;
use App\Services\PaidService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentsController extends Controller
{
    /**
     * @var PaidService
     */
    private $paidService;

    /**
     * PaymentsController constructor.
     * @param PaidService $paidService
     */
    public function __construct(PaidService $paidService)
    {
        parent::__construct();
        $this->paidService = $paidService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $orders = Order::query();
        $orders = $this->paidService->orderFilters($orders, $data);

        $orders = $orders->paginate(config('constants.per_page'));
        return view('dashboard.payments.index', compact('orders'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeStatus(Request $request)
    {
        $data = $request->all();
        $status = $data['payment_change'];
        $order = Order::find($data['order_id']);

        $order->cu_status_placila = $status;
        $order->save();

        if($order->cu_status_placila == 1){
            $view = 'emails.invoice';
            $viewData = [
                'subject' => "Invoice message",
                'email' => $order->customer->user->email,
                'order' => $order
            ];
            EmailCreateService::create(
                $order->customer->id,
//                $product->customer->email_address,
                $order->customer->user->email,
                $viewData['subject'],
                view($view, $viewData)->render(),
                'emails.invoice',
                config('constants.email_type.invoice')
//
            );
        }


        return redirect()->route('payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $order = Order::find($id);
//        dd($order);
        $bookings = $order->storitevToOrders()->paginate(config('constants.per_page'));
        return view('dashboard.payments.show', compact('order', 'bookings'));
    }

    public function downloadPDF(Request $request)
    {
        $data = $request->all();
//        $file_name = Str::uuid();
        $orders = Order::query();

        $orders = $this->paidService->orderFilters($orders, $data);

        $orders = $orders->get();
        $pdf = PDF\Pdf::loadView('files.orderPDF', ['orders' => $orders]);
        return $pdf->download('orders.pdf'); //->deleteFileAfterSend(true);


//        $path = 'invoices/' . $today . '/' . $order->business_id;
//        Storage::makeDirectory($path);
//        $pdf->save(storage_path('app/public/') . $path . '/' . $file_name . '.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
