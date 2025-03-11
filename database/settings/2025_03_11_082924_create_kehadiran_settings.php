<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $keys = [
            'kehadiran.start_time',
            'kehadiran.end_time',
            'kehadiran.allow_late_check_in',
            'kehadiran.auto_absent_after',
        ];
        foreach ($keys as $key) {
            if (! $this->migrator->exists($key)) {
                $this->migrator->add($key);
            }
        }
    }
};
