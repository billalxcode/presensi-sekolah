<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiswaDetails>
 */
class SiswaDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => random_int(00000, 99999),
            'tanggal_lahir' => fake('id_ID')->date(),
            'tempat_lahir' => 'Majalengka',
        ];
    }
}
