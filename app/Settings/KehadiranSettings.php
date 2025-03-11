<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class KehadiranSettings extends Settings
{
    public ?string $start_time;

    public ?string $end_time;

    public ?bool $allow_late_check_in;

    public ?string $auto_absent_after;

    public static function group(): string
    {
        return 'kehadiran';
    }

    public function isStartPresent()
    {
        $general_settings = new GeneralSettings;

        $currentTime = now($general_settings->timezone ?? 'Asia/Jakarta');
        $startTime = $this->start_time ? now($general_settings->timezone ?? 'Asia/Jakarta')
            ->setTimeFromTimeString($this->start_time) : null;
        $endTime = $this->end_time ? now($general_settings->timezone ?? 'Asia/Jakarta')
            ->setTimeFromTimeString($this->end_time) : null;
        $autoAbsentAfter = $this->auto_absent_after ? (int) $this->auto_absent_after : 0;

        if (! $startTime || ! $endTime) {
            return false;
        }

        if ($this->allow_late_check_in) {
            $endTime->addMinutes($autoAbsentAfter);
        }

        return $currentTime->greaterThanOrEqualTo($startTime) &&
                    $currentTime->lessThanOrEqualTo($endTime);
    }
}
