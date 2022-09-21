<?php

namespace App\Http\Controllers;

use App\Services\PaypalService;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use function Symfony\Component\Mime\Header\all;

class PayPalController extends Controller
{
    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function payment(Request $request)
    {
        $data = $request->all();
        $paypalInfo = [];

        try {
            $paypalInfo['total'] = 3; //$data['price'];
            $paypalInfo['listing_id'] = 1613617; //$data['listing_id'];
            $paypalInfo['shipping'] = 0;
            $paypalInfo['tax'] = 0;

            $paypal = new PaypalService();
            $authorization = $paypal->setAuthorization(
                $paypalInfo['total'],
                $paypalInfo['listing_id'],
                $paypalInfo['shipping'],
                $paypalInfo['tax'],
                'Order',
                false
            );
//            dd($authorization['url']);

            return redirect($authorization['url']);

        } catch (\Exception $e) {
            DB::rollback();
        }
//        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @param Request $request
     * @param $listing_id
     * @return Response
     */
    public function success(Request $request, $listing_id)
    {
//        dd($listing_id);
        $params = $request->all();
        $paypalInfo = [];
        try {
            if (isset($params["token"]) && isset($params["PayerID"])) {

//              //  Test data  //
                $paypalInfo['total'] = $params['price'] ?? 3;
                $paypalInfo['shipping'] = 0;
                $paypalInfo['tax'] = 0;
//                ///////////////


                $paypal = new PaypalService();

                $response = $paypal->createAuthorization(
                    $params["token"],
                    $params["PayerID"],
                    $paypalInfo['total'],
                    $paypalInfo['shipping'],
                    $paypalInfo['tax'],
                    'Order'
                );

                dd($response);

                DB::beginTransaction();


                DB::commit();

                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
