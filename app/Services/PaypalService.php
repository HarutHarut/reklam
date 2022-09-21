<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class PaypalService
{
    private $PayPalMode; // sandbox or live
    private $PayPalCurrencyCode; //Paypal Currency Code

    private $PayPalApiUsername; //PayPal API Username
    private $PayPalApiPassword; //Paypal API password
    private $PayPalApiSignature;//Paypal API Signature

    private $PayPalCancelURL = '/cancel';
    private $PayPalReturnUrl = '/payment/success/';

    function __construct()
    {
        $this->PayPalMode = env('PAYPAL_MODE');
        $this->PayPalCurrencyCode = env('PAYPAL_CURRENCY');
        $this->PayPalApiUsername = env('PAYPAL_SANDBOX_API_USERNAME');
        $this->PayPalApiPassword = env('PAYPAL_SANDBOX_API_PASSWORD');
        $this->PayPalApiSignature = env('PAYPAL_SANDBOX_API_SECRET');
    }

    function setAuthorization($itemsTotal, $listing_id = '', $shipping, $tax, $type = 'Order', $isReprint = false)
    {
        $itemsTotal = str_replace(',', '', $itemsTotal);
        $PayPalReturnUrl = env('FRONT_URL') . $this->PayPalReturnUrl . $listing_id;
        $PayPalCancelURL = env('FRONT_URL') . $this->PayPalCancelURL;

        $padata = '&METHOD=SetExpressCheckout' .
            '&RETURNURL=' . urlencode(env('APP_URL') . $PayPalReturnUrl) .
            '&CANCELURL=' . urlencode(env('APP_URL') . $PayPalCancelURL) .
            '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($type) .
            '&NOSHIPPING=1' .
            '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($itemsTotal) .
            '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($tax) .
            '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($shipping) .
            '&PAYMENTREQUEST_0_AMT=' . urlencode($itemsTotal + $shipping + $tax) .
            '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($this->PayPalCurrencyCode) .
            '&LOGOIMG='.
            '&CARTBORDERCOLOR=FFFFFF' .
            '&ALLOWNOTE=0';


        $httpParsedResponseAr = $this->PPHttpPost('SetExpressCheckout', $padata);

        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $ppmode = ($this->PayPalMode == 'sandbox') ? '.sandbox' : '';
            $paypalurl = 'https://www' . $ppmode . '.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=' . $httpParsedResponseAr["TOKEN"] . '';
            $response = [
                'success' => true,
                'url' => $paypalurl
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment.'
            ];

        }
        return $response ?? null;
    }

    function createAuthorization($token, $payer_id, $itemsTotal, $shipping, $tax, $type = 'Order')
    {
        $response = array();
        $padata = '&TOKEN=' . urlencode($token);
        $httpParsedResponseAr = $this->PPHttpPost('GetExpressCheckoutDetails', $padata);
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $preTotal = urldecode($httpParsedResponseAr["AMT"]);
            Log::error('error: PAYPAL DETAILS -- ' . print_r($httpParsedResponseAr, true));
            $xTotal = $itemsTotal + $shipping + $tax;
            $epsilon = 0.01;
            if (abs($xTotal - $preTotal) >= $epsilon) {
                $response['success'] = 0;
                $response['message'] = 'Your cart items have changed since your approval, please re-do your shipments';
            } else {
                $padata = '&TOKEN=' . urlencode($token) .
                    '&PAYERID=' . urlencode($payer_id) .
                    '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($type) .
                    '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($itemsTotal) .
                    '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($tax) .
                    '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($shipping) .
                    '&PAYMENTREQUEST_0_AMT=' . urlencode($xTotal) .
                    '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($this->PayPalCurrencyCode);

                $httpParsedResponseAr = $this->PPHttpPost('DoExpressCheckoutPayment', $padata);
                if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
                    $padata = '&TOKEN=' . urlencode($token);
                    $transactionId = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
                    $httpParsedResponseAr = $this->PPHttpPost('GetExpressCheckoutDetails', $padata);
                    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
                        $preTotal = urldecode($httpParsedResponseAr["AMT"]);
                        $epsilon = 0.01;
                        if (abs($xTotal - $preTotal) >= $epsilon) {
                            $response['success'] = 0;
                            $response['message'] = "The total of the order doesn't match the total payed. Your order wont be processed, please contact us at support@4over4.com if you need a refund.";
                        } else {
                            $response['success'] = 1;
                            $response['authorizationId'] = $transactionId;
                        }
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment.';
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment.';
                }
            }
        } else {
            $response['success'] = 0;
            $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment.';
        }
        return $response;
    }

    function createAuthorizationFast($token, $payer_id, $type = 'Order')
    {
        $response = array();
        $padata = '&TOKEN=' . urlencode($token);
        $httpParsedResponseAr = $this->PPHttpPost('GetExpressCheckoutDetails', $padata);

        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $shipping = urldecode($httpParsedResponseAr["SHIPPINGAMT"]);
            $tax = urldecode($httpParsedResponseAr["TAXAMT"]);
            $itemsTotal = urldecode($httpParsedResponseAr["AMT"]) - $shipping - $tax;
            $totalTotal = urldecode($httpParsedResponseAr["AMT"]);
            $padata = '&TOKEN=' . urlencode($token) .
                '&PAYERID=' . urlencode($payer_id) .
                '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($type) .
                '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($itemsTotal) .
                '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($tax) .
                '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($shipping) .
                '&PAYMENTREQUEST_0_AMT=' . urlencode($totalTotal) .
                '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($this->PayPalCurrencyCode);

            $httpParsedResponseAr = $this->PPHttpPost('DoExpressCheckoutPayment', $padata);
            //Check if everything went ok..
            if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
                $padata = '&TOKEN=' . urlencode($token);
                $transactionId = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
                //log_message('error','PAYPAL CONFIRMATION:  '. $transactionId);
                //log_message('error','PAYPAL CONFIRMATION: ' . print_r($httpParsedResponseAr,true));
                $httpParsedResponseAr = $this->PPHttpPost('GetExpressCheckoutDetails', $padata);
                if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

                    $response['success'] = 1;
                    $response['authorizationId'] = $transactionId;
                    $response['total'] = $totalTotal;
                    //print_r($httpParsedResponseAr);

                } else {
                    $response['success'] = 0;
                    $response['message'] = ' PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment';
                    //log_message('error','PAYPAL ERROR:' . print_r($httpParsedResponseAr,true));
                }
            } else {
                //log_message('error','PAYPAL ERROR:' . print_r($httpParsedResponseAr,true));
                $response['success'] = 0;
                $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment';
            }

        } else {
            //log_message('error','PAYPAL ERROR:' . print_r($httpParsedResponseAr,true));
            $response['success'] = 0;
            $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment';
        }
        return $response;
    }

    function captureAuthorization($total, $authorizationId)
    {

        $padata = '&METHOD=DoCapture' .
            '&AUTHORIZATIONID=' . urlencode($authorizationId) .
            '&AMT=' . urlencode($total) .
            '&CURRENCYCODE=' . urlencode($this->PayPalCurrencyCode) .
            '&COMPLETETYPE=Complete';
        $httpParsedResponseAr = $this->PPHttpPost('DoCapture', $padata);

        //Respond according to message we receive from Paypal
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $response = array();
            $response['success'] = 1;
            return $response;
        } else {
            //log_message('error','PAYPAL ERROR ' . $authorizationId . " : " . print_r($httpParsedResponseAr,true));
            $response = array();
            $response['success'] = 0;
            $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment.';
            $response['error'] = urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);
            return $response;
        }
    }

    function PPHttpPost($methodName_, $nvpStr_)
    {

        // Set up your API credentials, PayPal end point, and API version.
        $API_UserName = urlencode($this->PayPalApiUsername);
        $API_Password = urlencode($this->PayPalApiPassword);
        $API_Signature = urlencode($this->PayPalApiSignature);

        $PayPalMode = ($this->PayPalMode == 'sandbox') ? '.sandbox' : '';

        $API_Endpoint = "https://api-3t" . $PayPalMode . ".paypal.com/nvp";
        $version = urlencode('109.0');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
        $httpResponse = curl_exec($ch);

        if (!$httpResponse) {
//            log_message('error', "PAYPAL: $methodName_ failed: " . curl_error($ch) . '(' . curl_errno($ch) . ')');
            return array('ACK' => 'ERROR');
        }

        $httpResponseAr = explode("&", $httpResponse);

        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }
        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            //log_message('error',"PAYPAL FATAL 1: Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
            //log_message('error',"PAYPAL FATAL 2: " . print_r($httpResponseAr,true));
            return array('ACK' => 'ERROR');
        }

        return $httpParsedResponseAr;
    }

    function setAuthorizationAjax($itemsTotal, $shipping, $tax, $type = 'Order', $return = 'https://4over4.com/checkout/paypal_checkout_continue')
    {
        $padata = '&METHOD=SetExpressCheckout' .
            '&RETURNURL=' . urlencode($return) .
            '&CANCELURL=' . urlencode($this->PayPalCancelURL) .
            '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($type) .
            '&NOSHIPPING=1' .
            '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($itemsTotal) .
            '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($tax) .
            '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($shipping) .
            '&PAYMENTREQUEST_0_AMT=' . urlencode($itemsTotal + $shipping + $tax) .
            '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($this->PayPalCurrencyCode) .
            '&LOGOIMG=' .
            '&CARTBORDERCOLOR=FFFFFF' .
            '&ALLOWNOTE=0';

        //log_message('error','PAYPAL SEND: '. $padata);

        $httpParsedResponseAr = $this->PPHttpPost('SetExpressCheckout', $padata);

        //Respond according to message we receive from Paypal
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            //Redirect user to PayPal store with Token received.
            $ppmode = ($this->PayPalMode == 'sandbox') ? '.sandbox' : '';
            $paypalurl = 'https://www' . $ppmode . '.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=' . $httpParsedResponseAr["TOKEN"] . '';
            $response = array();
            $response['success'] = 2;
            $response['redirect'] = $paypalurl;
            $response['message'] = '';
        } else {
            //log_message('error','PAYPAL ERROR:' . print_r($httpParsedResponseAr,true));
            $response = array();
            $response['success'] = 0;
            $response['message'] = 'PayPal payment has been declined. Please call our office at 718-932-2700 to arrange for alternate payment.';
            $response['redirect'] = '';
        }
        return $response;
    }
}

