<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->role == 'admin';
    }

    public function isSeller(): bool
    {
        return $this->role == 'seller';
    }

    public function isActive(): bool
    {
        return $this->status == 1;
    }

    public function isAFilamentAllowed()
    {
        return $this->isAdmin() || $this->isSeller();
    }

    const USERTYPES = [
        'admin' => 'Admin',
        'seller' => 'Seller',
    ];

    //set default password
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }


    // public function sellerInfo()
    public function sellerInfo(): HasOne
    {
        return $this->hasOne(SellerInfo::class);
    }


    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class);
    }

    public function getBalanceAttribute()
    {
        return $this->balance()->first() ? $this->balance()->first()->remainingBalance() : 0;
    }

    public function deductBalance(): void
    {
        $this->uploads -= 1;
        $this->save();
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function canAccessFilament(): bool
    {
        return $this->isAFilamentAllowed();
    }

    public function isAllowedToView(){
        return $this->active_until > now();
    }


    //paymenthistory through paymenttransaction
    public function paymentHistory()
    {
        return $this->hasManyThrough(PaymentHistory::class,PaymentTransaction::class);
    }
}
