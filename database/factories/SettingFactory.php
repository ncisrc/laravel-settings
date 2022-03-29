<?php

namespace Nci\SettingsPackage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nci\SettingsPackage\Enums\SettingType;
use Nci\SettingsPackage\Models\Setting;
use ReflectionClass;

class SettingFactory extends Factory
{

    protected $model = Setting::class;

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
            'namespace'   => $this->faker->word(),
            'scope'       => rand(0, 1) ? 'App' : 'User',
            'code'        => $this->faker->unique()->word(),
            'description' => $this->faker->text(),
            'type'        => strtolower(array_rand($types)),
            'nullable'    => true,
            'favorite'    => false,
            'width'       => $widths[array_rand($widths)]
        ];
    }

    /**
     * Set setting scope to user
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function userScope()
    {
        return $this->state(function (array $attributes) {
            return [
                'scope' => 'User'
            ];
        });
    }

    /**
     * Set setting scope to app
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function appScope()
    {
        return $this->state(function (array $attributes) {
            return [
                'scope' => 'App'
            ];
        });
    }
}