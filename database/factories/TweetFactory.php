<?php

namespace Database\Factories;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TweetFactory extends Factory
{
    protected $model = Tweet::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'content' => Str::random(64),
        ];
    }

}
