<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comments;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();

        User::create([
            'name' => 'Angga VB',
            'username' => 'anggavb',
            'email' => 'anggavb8@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        Post::factory(30)->create();

        Comments::factory(50)->create();
        
        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
        ]);

        Category::create([
            'name' => 'Life Style',
            'slug' => 'life-style',
        ]);

        Category::create([
            'name' => 'Vacation',
            'slug' => 'vacation',
        ]);
    }
}
