<?php

namespace Modules\Admin\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Admin\Models\Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

