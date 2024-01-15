<?php

namespace App\Filament\Resources\HotelResource\Pages;

use App\Filament\Resources\HotelResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotel extends CreateRecord
{
    protected static string $resource = HotelResource::class;


    protected function getRedirectUrl(): string
    {
        return HotelResource::getUrl('index');
    }


    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Hotel Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make('Hotel created')
            ->title('Hotel created')
            ->persistent()
            ->icon('heroicon-o-check-circle')
            ->success()
            ->body('A new hotel has been created, it will be listed soon. Thank you')
            ->send();
    }

    protected function getTitle(): string
    {
        return 'Add Hotel';
    }
}
