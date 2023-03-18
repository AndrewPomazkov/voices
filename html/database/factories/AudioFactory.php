<?php

namespace Database\Factories;

use App\Models\Audio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Audio>
 */
class AudioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Audio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->faker->url,
            'filename' => $this->faker->fileExtension,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
