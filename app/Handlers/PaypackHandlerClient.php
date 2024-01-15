<?php

namespace App\Handlers;

use Paypack\Paypack;

class PaypackHandlerClient
{
    protected $paypack;

    public function __construct()
    {
        $this->paypack = new Paypack();
        $this->paypack->config([
            'client_id' => config('payment_keys_client.PAYPACK_CLIENT_ID'),
            'client_secret' => config('payment_keys_client.PAYPACK_CLIENT_SECRET'),
            'webhook_mode' => 'production'
        ]);

    }

    public function cashin($phone, $amount)
    {
        return $this->paypack->Cashin([
            'phone' => $phone,
            'amount' => $amount
        ]);
    }

    public function cashout($phone, $amount)
    {

        return $this->paypack->Cashout([
            'phone' => $phone,
            'amount' => $amount
        ]);
    }


    public function checkPayment($ref)
    {
        return $this->paypack->Transaction($ref);
    }
}
