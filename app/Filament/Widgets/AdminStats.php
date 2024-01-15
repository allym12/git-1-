<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class AdminStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Properties', \App\Models\House::count())
                ->icon('heroicon-s-home'),
            Card::make('Total Users', \App\Models\User::count())
                ->icon('heroicon-s-user-group'),
            Card::make('Total Sellers', \App\Models\User::where('role', 'seller')->count())
                ->icon('heroicon-s-user-group'),
            Card::make('Total Successful Transactions', \App\Models\PaymentTransaction::where('status', '1')->count())
                ->icon('heroicon-s-cash'),

        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }
}
