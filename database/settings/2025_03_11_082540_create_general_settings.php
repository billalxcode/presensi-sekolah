<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $keys = [
            'general.school_name' => 'SMKN 1 Maja',
            'general.timezone' => 'Asia/Jakarta',
        ];
        foreach ($keys as $key => $payload) {
            if (! $this->migrator->exists($key)) {
                $this->migrator->add($key, $payload);
            }
        }
    }
};
