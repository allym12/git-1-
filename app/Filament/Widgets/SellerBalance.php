<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class SellerBalance extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected function getCards(): array
    {
        return [
            Card::make('Your uploads balance', auth()->user()->uploads)
                ->icon('heroicon-s-cash'),
            Card::make('Active properties', auth()->user()->houses()->where('status', '1')->count())
                ->icon('heroicon-s-home'),
            Card::make('Inactive properties', auth()->user()->houses()->where('status', '0')->count())
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }


    public static function canView(): bool
    {
        return auth()->user()->isSeller();
    }
}
