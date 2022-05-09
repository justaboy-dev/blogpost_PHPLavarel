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
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => $this->faker->sentence(),
        ];
    }
}
