<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'previous_balance',
        'current_balance',
        'payment_transaction_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentTransaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class);
    }


    public function remainingBalance(): int
    {
        //latest current balance wheren payment_transaction_id status is 1
        $latestBalance = Balance::query()
            ->withWhereHas('paymentTransaction', function ($query) {
                $query->where('status', 1);
            })
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->first();

        if ($latestBalance) {
            return $latestBalance->current_balance;
        }

        return 0;
    }


public function previousBalance(): int
    {
        //latest current balance wheren payment_transaction_id status is 1
        $latestBalance = Balance::query()
            ->withWhereHas('paymentTransaction', function ($query) {
                $query->where('status', 1);
            })
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->first();

        if ($latestBalance) {
            return $latestBalance->previous_balance;
        }

        return 0;
    }



}
