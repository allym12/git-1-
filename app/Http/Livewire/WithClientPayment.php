<?php

namespace App\Http\Livewire;

use App\Handlers\EsiciaHandler;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait WithClientPayment
{
    public $phone;
    public $paymentProcessStarted = false;

    public function pay()
    {
        $this->validate([
            'phone' => 'required|numeric|max_digits:16',
        ]);

        $this->paymentProcessStarted = true;


        $user = User::firstOrCreate([
            'phone' => $this->phone,
        ], [
            'password' => Hash::make('password'),
            'name' =>  $this->phone
        ]);

        event(new Registered($user));

        Auth::login($user);

        $payment_phone = $this->phone;
        $amount = config('payouts.viewing_cost');
        $ref = uniqid();

        $response = new EsiciaHandler(amount: $amount,phone: $payment_phone, refid: $ref);
        $data['transaction_id'] = $ref;
        $data['ref'] = 'response';
        $data['payment_phone'] = $this->phone;
        $data['total_amount'] = config('payouts.viewing_cost');
        $user->paymentTransactions()->create($data);
        return redirect()->back();

    }

}
