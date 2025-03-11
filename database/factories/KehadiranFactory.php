<?php

namespace Database\Factories;

use App\Models\SiswaDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kehadiran>
 */
class KehadiranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['hadir', 'izin', 'sakit', 'alpha']),
            'keterangan' => fake('id_ID')->sentence(),
            'siswa_id' => SiswaDetails::all('id')->random(),
            'verified_by' => null,
        ];
    }
}
