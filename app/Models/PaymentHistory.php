<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentHistory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['payment_transaction_id','active_until'];

    public function paymentTransaction()
    {
        return $this->belongsTo(PaymentTransaction::class);
    }
}
