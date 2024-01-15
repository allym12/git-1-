<?php

namespace App\Filament\Resources\LandResource\Pages;

use App\Filament\Resources\LandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLand extends EditRecord
{
    protected static string $resource = LandResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
