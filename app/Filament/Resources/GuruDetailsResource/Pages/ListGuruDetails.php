<?php

namespace App\Filament\Resources\GuruDetailsResource\Pages;

use App\Filament\Resources\GuruDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuruDetails extends ListRecords
{
    protected static string $resource = GuruDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
