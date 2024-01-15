<?php

namespace App\Filament\Resources\LandResource\Pages;

use App\Filament\Resources\LandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLand extends CreateRecord
{
    protected static string $resource = LandResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
