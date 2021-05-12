<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        $user = User::factory()->create();
        $shop = Shop::factory()->create();
        return [
            'shop_id' => $shop->id,
            'sender_id' => $user->id,
            'sender_type' => 'App\\Models\\User',
            'message' => $this->faker->text,
            'score' => $this->faker->numberBetween(1, 5),
        ];
    }
}
