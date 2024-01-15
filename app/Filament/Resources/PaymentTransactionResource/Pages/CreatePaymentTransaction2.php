<?php

namespace App\Filament\Resources\PaymentTransactionResource\Pages;

use App\Filament\Resources\PaymentTransactionResource;
use App\Handlers\PaypackHandler;
use App\Models\Balance;
use App\Models\PaymentTransaction;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentTransaction2 extends CreateRecord
{
    protected static string $resource = PaymentTransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $payment_phone = $data['payment_phone'];

        $amount = $data['number_of_uploads'] * config('payouts.uploading_cost');





        $handler = new PaypackHandler();
        $response = $handler->cashin($payment_phone, $amount);

        $data['transaction_id'] = $response['ref'];
        $data['ref'] = $response;
        return $data;
    }

    protected function afterCreate(): void
    {

        Balance::create([
            'user_id' => auth()->user()->id,
            'previous_balance' => auth()->user()->current_balance,
            'current_balance' => auth()->user()->current_balance + 100,
            'payment_transaction_id' => $this->record->id,
        ]);

    }

}
