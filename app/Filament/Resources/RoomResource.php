<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\GuruDetails;
use App\Models\Room;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'fas-chalkboard-user';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make([
                TextInput::make('name')
                    ->placeholder('Masukan nama ruangan'),
                Select::make('guru_id')
                    ->options(GuruDetails::all()->pluck('user.name', 'id'))
                    ->label('Wali kelas')
                    ->placeholder('Pilih wali kelas')
                    ->native(false)
                    ->searchable()
                    ->reactive()
                    ->live(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guru.user.name')
                    ->default('Tidak ada')
                    ->label('Wali Kelas')
                    ->formatStateUsing(fn ($state) => $state ?? 'Tidak ada')
                    ->badge()
                    ->color(fn ($state) => $state !== 'Tidak ada' ? Color::Green : Color::Gray),
                TextColumn::make('total_siswa')
                    ->label('Total Siswa')
                    ->getStateUsing(function ($record) {
                        return $record->siswas()->count().' Siswa';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
