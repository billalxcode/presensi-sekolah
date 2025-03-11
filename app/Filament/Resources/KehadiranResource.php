<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KehadiranResource\Pages;
use App\Models\Kehadiran;
use App\Models\Room;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KehadiranResource extends Resource
{
    protected static ?string $model = Kehadiran::class;

    protected static ?string $navigationIcon = 'fas-user-check';

    protected static ?string $navigationGroup = 'Kehadiran Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->when(
                ! request()->has('tableFilters'),
                fn ($query) => $query->where('created_at', now())
            ))
            ->columns([
                TextColumn::make('siswa.user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('siswa.kelas.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => str($state)->upper())
                    ->color(function ($state) {
                        if ($state == 'alpha') {
                            return Color::Red;
                        } elseif ($state == 'hadir') {
                            return Color::Green;
                        } elseif ($state == 'sakit') {
                            return Color::Gray;
                        } elseif ($state == 'izin') {
                            return Color::Yellow;
                        }
                    }),
                TextColumn::make('keterangan')
                    ->default('Tidak diketahui')
                    ->formatStateUsing(fn ($state) => str($state)->limit(20, '...')),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->placeholder('From'),
                        DatePicker::make('created_until')
                            ->placeholder('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
                Tables\Filters\SelectFilter::make('kelas')
                    ->relationship('siswa.kelas', 'name')
                    ->multiple()
                    ->label('Kelas')
                    ->options(Room::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\Action::make('change-status')
                    ->icon('fas-edit')
                    ->modalWidth('sm')
                    ->form([
                        Select::make('status')
                            ->formatStateUsing(fn (Kehadiran $record) => $record->status)
                            ->options(['hadir' => 'HADIR', 'sakit' => 'SAKIT', 'izin' => 'IZIN', 'alpha' => 'ALPHA'])
                            ->native(false)
                            ->live()
                            ->required(),
                        Textarea::make('keterangan')
                            ->formatStateUsing(fn (Kehadiran $record) => $record->keterangan),
                    ])
                    ->action(function (Kehadiran $record, $data) {
                        $record->update($data);

                        Notification::make()
                            ->title('Changed')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKehadirans::route('/'),
            'create' => Pages\CreateKehadiran::route('/create'),
            'edit' => Pages\EditKehadiran::route('/{record}/edit'),
        ];
    }
}
