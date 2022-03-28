<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nci\SettingsPackage\Enums\SettingType;
use ReflectionClass;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ref    = new ReflectionClass(SettingType::class);
        $types  = $ref->getConstants();
        $widths = ['1/4', '1/3', '1/2', '2/3', '3/4', 'full'];

        return [
            'group'       => $this->faker->word(),
            'scope'       => rand(0, 1) ? 'App' : 'User',
            'code'        => $this->faker->unique()->word(),
            'description' => $this->faker->text(),
            'type'        => strtolower(array_rand($types)),
            'nullable'    => true,
            'favorite'    => false,
            'width'       => $widths[array_rand($widths)]
        ];
    }
}