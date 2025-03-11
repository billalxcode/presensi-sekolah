<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Room;
use App\Models\SiswaDetails;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswaResource extends Resource
{
    protected static ?string $model = SiswaDetails::class;

    protected static ?string $navigationIcon = 'fas-users';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Account')
                        ->schema([
                            Section::make('Informasi akun')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Nama lengkap')
                                        ->columnSpan(1)
                                        ->placeholder('Masukan nama lengkap')
                                        ->required()
                                        ->autocomplete(false),
                                    TextInput::make('email')
                                        ->email()
                                        ->columnSpan(1)
                                        ->placeholder('Masukan email')
                                        ->required()
                                        ->autocomplete(false),
                                ]),
                            Section::make('Keamanan')
                                ->schema([
                                    TextInput::make('password')
                                        ->placeholder('Masukan kata sandi')
                                        ->password()
                                        ->revealable()
                                        ->required()
                                        ->autocomplete(false),
                                ]),
                        ])
                        ->hiddenOn('edit'),
                    Wizard\Step::make('Informasi Detail')
                        ->schema([
                            TextInput::make('nis')
                                ->unique()
                                ->label('Nomor Induk Siswa')
                                ->placeholder('Masukan Nomor Induk Siswa')
                                ->required()
                                ->autocomplete(false),
                            DatePicker::make('tanggal_lahir')
                                ->placeholder('Masukan tanggal lahir')
                                ->required(),
                            TextInput::make('tempat_lahir')
                                ->placeholder('Masukan tempat lahir')
                                ->required()
                                ->autocomplete(false),
                            Select::make('kelas_id')
                                ->options(Room::all()->pluck('name', 'id'))
                                ->live()
                                ->native(false)
                                ->searchable()
                                ->reactive()
                                ->required(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(components: [
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kelas.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(Color::Green),
                TextColumn::make('tanggal_lahir')
                    ->searchable()
                    ->sortable()
                    ->date(),
                TextColumn::make('tempat_lahir')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('change_password')
                        ->label('Change Password')
                        ->icon('carbon-password')
                        ->modalWidth('sm')
                        ->modalIcon('heroicon-o-exclamation-circle')
                        ->modalIconColor(Color::Red)
                        ->form([
                            TextInput::make('new_password')
                                ->password()
                                ->revealable()
                                ->required()
                                ->placeholder('Masukan password baru'),
                        ])
                        ->action(function (SiswaDetails $record, $data) {
                            $record->user->update([
                                'password' => $data['new_password'],
                            ]);
                            Notification::make()
                                ->title('Changed')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\EditAction::make(),
                ]),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
