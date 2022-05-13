<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    public function definition()
    {
        return [
            'tittle' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => $this->faker->sentence(),
            'public' => $this->faker->boolean(),
            'views' => $this->faker->numberBetween(0, 100),
        ];
    }
}
