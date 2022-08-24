<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orang>
 */
class OrangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jk = abs(rand(1,2));
        return [
            'nama' =>  $this->faker->name(($jk==1)?'male':'female'),
            'jenis_kelamin'=> $jk,
            'tanggal_lahir'=>$this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
            'asal_id' => [6109,6110,6111,6112][abs(rand(0,3))],
        ];
    }
}
