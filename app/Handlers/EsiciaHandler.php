<?php

namespace App\Handlers;



class EsiciaHandler
{
    protected $paypack;

    public function __construct($amount, $phone, $cname = 'client', $email = null, $refid = null)
    {
        $url = "https://pay.esicia.rw/";
        $curl = curl_init($url);
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
          "returl":"https://callback.worldmarketconnect.rw/callback2.php",
          "redirecturl":"https://worldmarketconnect.rw",
          "bankid":"63510"
        }
        DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);


        return $resp;
    }

}
