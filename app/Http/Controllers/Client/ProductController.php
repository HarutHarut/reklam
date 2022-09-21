<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ReportRequest;
use App\Models\Contacts;
use App\Models\MaliOglasi;
use App\Models\Zloraba;
use App\Services\EmailCreateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * @param string $slug
     * @return Response
     */
    public function index(string $slug)
    {
        $product = MaliOglasi::query()
            ->where(['slug' => $slug])
            ->with('customer')
            ->firstOrFail();

        if (!Session::get('views_count')) {
            $product->update(['views_count' => ++$product->views_count]);
            Session::put('views_count', 'Sabuz');
        }

        $similarProducts = MaliOglasi::query()
            ->where('slug', '!=', $slug)
            ->where('tip1', $product->tip1)->inRandomOrder()
            ->limit(5)
            ->get();

        return response()->view('client.product.index', compact('product', 'similarProducts'));
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(ContactRequest $request){
        $data = $request->validated();
        $product = MaliOglasi::find($data['product_id']);
        try {
            $contact = Contacts::create([
                'name' => $data['name'],
                'listing_name' => $product->naslov,
                'from_email' => $data['email'],
                'to_email' => $product->customer->email_address,
                'message' => $data['msg']

            ]);

            $view = 'emails.contact';
            $viewData = [
                'subject' => "Contact message",
                'email' => $product->customer->email_address,
                'contact' => $contact
            ];
            EmailCreateService::create(
                $product->customer->id,
//                $product->customer->email_address,
                $data['email'],
                $viewData['subject'],
                view($view, $viewData)->render(),
                'emails.contact',
                config('constants.email_type.contact_messages'),
//
            );

            return response()->json(['status' => 'success', 'data' => $contact], 200);

        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function sendReport(ReportRequest $request){
        $data = $request->validated();
        try {
            $report = Zloraba::create([
                'sender_id' => Auth::id() ?? null,
                'id_oglasa' => $data['product_id'],
                'zloraba_razlogi' => $data['msg'],
            ]);

//            $view = 'emails.contact';
//            $viewData = [
//                'subject' => "Contact message",
//                'email' => $product->customer->email_address,
//                'contact' => $contact
//            ];
//            EmailCreateService::create(
//                $product->customer->id,
////                $product->customer->email_address,
//                $data['email'],
//                $viewData['subject'],
//                view($view, $viewData)->render(),
//                'emails.contact',
//                config('constants.email_type.contact_messages'),
////
//            );

            return response()->json(['message' => 'Your report has been sent successfully'], 200);

        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
