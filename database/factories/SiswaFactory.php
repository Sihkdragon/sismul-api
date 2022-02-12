<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nisn' => $this->faker->numerify('##########'),
            'nama' => $this->faker->name(),
            'kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'tanggal_lahir' => $this->faker->date('Y-m-d')
        ];
    }
}
