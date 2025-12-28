<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tglMulai = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $tglSelesai = (clone $tglMulai)->modify('+' . rand(1, 5) . ' hours');

        return [
            'judul' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(4),
            'tgl_mulai' => $tglMulai,
            'tgl_selesai' => $tglSelesai,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
