<?php

namespace App\Filament\Resources\FashionResource\Pages;

use App\Filament\Resources\FashionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFashion extends CreateRecord
{
    protected static string $resource = FashionResource::class;

    protected function getRedirectUrl(): string
    {
        return FashionResource::getUrl('index');
    }
}
