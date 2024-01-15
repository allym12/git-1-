<?php

namespace App\Http\Livewire;

use App\Handlers\PaypackHandler;
use App\Handlers\PaypackHandlerClient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ClientPayComponent2 extends Component
{

    public $phone;

    public function pay()
    {
        $this->validate([
            'phone' => 'required|numeric|max_digits:16',
        ]);


        $user = User::firstOrCreate([
            'phone' => $this->phone,
        ], [
            'password' => Hash::make('password'),
            'name' =>  $this->phone
        ]);

        event(new Registered($user));

        Auth::login($user);

        $payment_phone = $this->phone;
        $handler = new PaypackHandlerClient();
        $amount = config('payouts.viewing_cost');
        $response = $handler->cashin($payment_phone, $amount);

        $data['transaction_id'] = $response['ref'];
        $data['ref'] = $response;
        $data['payment_phone'] = $this->phone;
        $data['total_amount'] = config('payouts.viewing_cost');

        $user->paymentTransactions()->create($data);

        return redirect()->back();

    }
    public function render()
    {
        return view('livewire.client-pay-component');
    }
}
