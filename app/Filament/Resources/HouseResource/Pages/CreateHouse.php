<?php

namespace App\Filament\Resources\HouseResource\Pages;

use App\Filament\Resources\HouseResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHouse extends CreateRecord
{
    protected static string $resource = HouseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make('Property created')
            ->title('Property created')
            ->persistent()
            ->icon('heroicon-o-check-circle')
            ->success()
            ->body('A new property has been created, it will be listed soon. Thank you')
            ->send();
    }

    protected function getTitle(): string
    {
        return 'Add Property';
    }

}
