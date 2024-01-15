<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use App\Filament\Resources\PaymentTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCars extends ListRecords
{
    protected static string $resource = CarResource::class;

    protected function getActions(): array
    {
        return [


            Actions\Action::make('text')
                ->label(function () {
                    return auth()->user()->uploads > 0 ? 'you have upload balance of ' . auth()->user()->uploads : 'you are out of balance, click to pay';
                })
                ->link()
                ->icon(function () {
                    return auth()->user()->uploads > 0 ? 'heroicon-s-check' : 'heroicon-s-x-circle';
                })
                ->color(function () {
                    return auth()->user()->uploads > 0 ? 'primary' : 'danger';
                })
                ->disabled()
                ->hidden(fn() => auth()->user()->isAdmin()),

            Actions\CreateAction::make()->label('Upload new Car'),

            Actions\Action::make('view')
                ->label('New payment')
                ->icon('heroicon-o-cash')
                ->color('success')
                ->url(PaymentTransactionResource::getUrl('create'))
                ->hidden(fn() => auth()->user()->isAdmin())
                ->button(),
        ];
    }

    protected function getTitle(): string
    {
        return auth()->user()->isAdmin() ? 'All Cars' : 'My Cars';
    }
}
