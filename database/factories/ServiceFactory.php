<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'price' => '100000',
            'note_service' => 'ini keterangan',
            'img_service' => $this->faker->image(public_path('layanan/'), width:280, height:200, category:null, fullPath:false),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
