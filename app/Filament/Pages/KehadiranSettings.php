<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use App\Settings\KehadiranSettings as Kehadiran;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class KehadiranSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = Kehadiran::class;

    public function form(Form $form): Form
    {
        $general_settings = new GeneralSettings;

        return $form
            ->schema([
                Section::make('Time of Attendence')
                    ->schema([
                        TimePicker::make('start_time')
                            ->time()
                            ->native(false)
                            ->timezone($general_settings->timezone ?? 'Asia/Jakarta'),
                        TimePicker::make('end_time')
                            ->time()
                            ->native(false)
                            ->timezone($general_settings->timezone ?? 'Asia/Jakarta'),
                    ]),
                Section::make('Advanced')
                    ->schema([
                        Toggle::make('allow_late_check_in')
                            ->default(false)
                            ->reactive(),
                        TextInput::make('auto_absent_after')
                            ->suffix('Minute')
                            ->numeric()
                            ->disabled(fn ($get) => ! $get('allow_late_check_in'))
                            ->default(10),
                    ]),
            ]);
    }
}
