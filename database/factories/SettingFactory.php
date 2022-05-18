<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{

    
    public function definition()
    {
        return [
            'key' => 'key',
            'value' => $this->faker->sentence,
        ];
    }
}
