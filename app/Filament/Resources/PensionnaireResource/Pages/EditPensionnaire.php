<?php

namespace App\Filament\Resources\PensionnaireResource\Pages;

use App\Filament\Resources\PensionnaireResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPensionnaire extends EditRecord
{
    protected static string $resource = PensionnaireResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
