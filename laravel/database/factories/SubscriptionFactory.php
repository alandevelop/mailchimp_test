<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'list_id' => config('newsletter.lists.subscribers.id'),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->unique()->freeEmail,
            'is_subscribed' => 0,
            'synchronized_at' => null,
        ];
    }
}
