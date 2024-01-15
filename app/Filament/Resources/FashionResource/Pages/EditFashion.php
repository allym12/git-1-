<?php

namespace App\Filament\Resources\FashionResource\Pages;

use App\Filament\Resources\FashionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFashion extends EditRecord
{
    protected static string $resource = FashionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
