<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>'test',
            'description'=>'test',
            'user_id'=>1
        ];
    }
}
