<?php

namespace Database\Factories;

use App\Models\Pipeline;
use Illuminate\Database\Eloquent\Factories\Factory;

class PipelineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pipeline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'repository' => 'mydnic/gitweet.io',
            'private' => 1,
            'github_webhook_id' => 1111,
            'twitter_id' => 1111,
            'twitter_access_code' => '1111',
            'twitter_access_code_secret' => '1111',
            'twitter_username' => 'mydnic',
        ];
    }
}
