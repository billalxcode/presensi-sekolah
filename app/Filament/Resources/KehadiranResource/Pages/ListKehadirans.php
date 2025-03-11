<?php

namespace App\Filament\Resources\KehadiranResource\Pages;

use App\Filament\Resources\KehadiranResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListKehadirans extends ListRecords
{
    protected static string $resource = KehadiranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'hadir' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'hadir')),
            'sakit' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'sakit')),
            'izin' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'izin')),
            'alpha' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'alpha')),

        ];
    }
}
