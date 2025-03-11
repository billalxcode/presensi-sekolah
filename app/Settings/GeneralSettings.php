<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $school_name;

    public string $timezone;

    public static function group(): string
    {
        return 'general';
    }
}
