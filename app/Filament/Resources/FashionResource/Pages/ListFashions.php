<?php

namespace App\Filament\Resources\FashionResource\Pages;

use App\Filament\Resources\FashionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFashions extends ListRecords
{
    protected static string $resource = FashionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
