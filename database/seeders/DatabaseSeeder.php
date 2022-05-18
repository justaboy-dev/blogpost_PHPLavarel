<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Permission;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    private $settings = [
        'about_tittle',
        'about_description',
        'about_image',
        'about_sub_tittle',
        'about_sub_description',
        'about_contact_tittle',
        'address',
        'phone',
        'email',
        'contact_tittle',
    ];
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
        Setting::truncate();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();
        Role::factory(1)->create();
        Role::factory(1)->create(['name'=>'admin']);
        $page_route = Route::getRoutes();
        $permissionId = [];
        foreach($page_route as $route)
        {
            if(strpos($route->getName(),'admin') !== false )
            {
                $permission = Permission::create(['name'=>$route->getName()]);
                $permissionId[] = $permission->id;
            }
        }
        Role::where('name','admin')->first()->permissions()->sync($permissionId);
        $user = User::factory(7)->create();
        $default_cat = Category::factory()->create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
        ]);
        $default_cat->images()->save(Image::create([
            'path' => 'storage/images/uncategoried.png',
            'extension' => 'png',
            'name' => 'default_category',
            'imageable_id' => $default_cat->id,
            'imageable_type' => Category::class,
        ]));
        $category = Category::factory(2)->create();
        Tag::factory(3)->create();
        $post = Post::factory(10)->create();
        Comment::factory(10)->create();

        foreach ($user as $u) {
            $u->images()->save(Image::factory()->make());
        }
        foreach ($category as $cat) {
            $cat->images()->save(Image::factory()->make());
        }
        foreach ($post as $p) {
            $tags_ids = [];
            $tags_ids[] = Tag::all()->random()->id;
            $p->tags()->sync($tags_ids);
            $p->images()->save(Image::factory()->make());
        }
        foreach($this->settings as $setting)
        {
            Setting::create([
                'key' => $setting,
                'value' => '',
            ]);
        }
    }
}
