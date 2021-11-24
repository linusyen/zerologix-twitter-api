<?php

namespace Database\Factories;

use App\Models\Oauth;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OauthFactory extends Factory
{
    protected $model = Oauth::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'user_id' => 1,
            'platform' => 'twitter',
            'platform_id' => 12345,
            'token' => '12345-abcde',
            'payload' => json_encode(['test'=>'test']),
        ];
    }

}
