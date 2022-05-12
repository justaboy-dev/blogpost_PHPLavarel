<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        Role::truncate();
        Category::truncate();
        Post::truncate();
        Comment::truncate();
        Tag::truncate();
        Image::truncate();

        Schema::enableForeignKeyConstraints();
        Role::factory(1)->create();
        Role::factory(1)->create(['name'=>'admin']);
        $user = User::factory(7)->create();
        $category = Category::factory(4)->create();
        Tag::factory(4)->create();
        $post = Post::factory(50)->create();
        Comment::factory(150)->create();

        foreach ($user as $u) {
            $u->images()->save(Image::factory()->make());
        }
        foreach ($category as $cat) {
            $cat->images()->save(Image::factory()->make());
        }
        foreach ($post as $p) {
            $tags_ids = [];
            $tags_ids[] = Tag::all()->random()->id;
            $tags_ids[] = Tag::all()->random()->id;
            $tags_ids[] = Tag::all()->random()->id;
            $p->tags()->sync($tags_ids);
            $p->images()->save(Image::factory()->make());
        }
    }
}
