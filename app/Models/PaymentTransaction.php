<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PaymentTransaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $casts = [
        'ref' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'ref',
        'transaction_id',
        'status',
        'payment_phone',
        'number_of_uploads',
        'total_amount',
    ];
    //set default value user_id when create new record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->user_id = auth()->user()->id;

        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balance(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Balance::class);
    }


    public function paymentHistory()
    {
        return $this->hasOne(PaymentHistory::class);
    }


    protected static function booted()
    {


        if (auth()->user()){
            if (auth()->user()->role == 'seller'){
                static::addGlobalScope('user_id', function (Builder $builder) {
                    $builder->where('user_id', auth()->user()->id);
                });
            }elseif (auth()->user()->role == 'admin'){

            }
        }

    }

}
