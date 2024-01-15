<?php

namespace App\Providers;

use App\Filament\Resources\HouseResource;
use App\Filament\Resources\PaymentTransactionResource;
use App\Models\PaymentTransaction;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            if (auth()->user()){
                if (auth()->user()->isAdmin()) {
                    Filament::registerUserMenuItems([
                        UserMenuItem::make()
                            ->icon('heroicon-o-cash')
                            ->url(PaymentTransactionResource::getUrl())
                        ->label('Payments'),
                    ]);
                }
            }
        });
    }
}
