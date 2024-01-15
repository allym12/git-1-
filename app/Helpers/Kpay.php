<?php
namespace App\Helpers;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

class Kpay{

    public static function initiatePayment($phone, $amount = 100, $cname = 'client', $email = null)
    {
        $url = "https://pay.esicia.rw/";
        $curl = curl_init($url);
        $refid = uniqid();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Basic d29ybGRtYXJrZXQ6UHJpbWVAMTIz",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $phonenumber = $phone;
        $data = <<<DATA
        {
          "msisdn":"$phonenumber",
          "details":"Subscription",
          "refid":"$refid",
          "amount":$amount,
          "currency":"RWF",
          "email":"$email",
          "cname":"$cname",
          "cnumber":"$phonenumber",
          "pmethod":"momo",
          "retailerid":"01",
          "returl":"https://worldmarketconnect.rw/api/kpay_call_back",
          "redirecturl":"https://worldmarketconnect.rw",
          "bankid":"63510"
        }
        DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);


        return $resp;
    }
    
    public static function hasPaid() : bool
    {
        if (Session::has('payment_done')) {
            // The "payment_done" session is set.
            
            // Check if it has expired
            if (now()->gt(Session::get('payment_done_expires_at'))) {
                // The session has expired. You can remove it.
                Session::forget('payment_done');
                Session::forget('payment_done_expires_at');

                return false;
            } else {
                return true;
            }
        } else {
            // The "payment_done" session is not set.
            return false;
        }
    }

    public static function paymentSuccess() : void {
        Session::put('payment_done', true);
        Session::put('payment_done_expires_at', now()->addHours(2));
    }

    public static function checkPaymentFromEsiciaServer($refid, $tid){
        $url = "https://pay.esicia.rw/";
        $curl = curl_init($url);
        $refid = uniqid();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Basic d29ybGRtYXJrZXQ6UHJpbWVAMTIz",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $refo = $refid;
        $trans = $tid;
        $data = <<<DATA
        {
          "action":"checkstatus",
          "refid":"$refo",
          "tid" : "$trans"
        }
        DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);


        return $resp;
    }
}