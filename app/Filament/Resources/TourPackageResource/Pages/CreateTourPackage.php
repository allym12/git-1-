<?php

namespace App\Filament\Resources\TourPackageResource\Pages;

use App\Filament\Resources\TourPackageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTourPackage extends CreateRecord
{
    protected static string $resource = TourPackageResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
