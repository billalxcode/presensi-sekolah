<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings as General;
use DateTimeZone;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = General::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('school_name')
                            ->required(),
                        Select::make('timezone')
                            ->options(DateTimeZone::listIdentifiers())
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->live(),
                    ]),
            ]);
    }
}
