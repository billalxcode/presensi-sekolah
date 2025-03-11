<?php

namespace App\Filament\Resources\GuruDetailsResource\Pages;

use App\Filament\Resources\GuruDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuruDetails extends EditRecord
{
    protected static string $resource = GuruDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
