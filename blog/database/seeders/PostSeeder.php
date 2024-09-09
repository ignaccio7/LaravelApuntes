<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post();

        $post->title = 'Post 1';
        $post->content = "Contenido 1";
        $post->category = "Categoria 1";
        $post->slug = "post-1";
        $post->published_at = now();

        $post->save();

        $post = new Post();

        $post->title = 'Post 2';
        $post->content = "Contenido 2";
        $post->category = "Categoria 2";
        $post->slug = "post-2";

        $post->save();

        $post = new Post();

        $post->title = 'Post 3';
        $post->content = "Contenido 3";
        $post->category = "Categoria 3";
        $post->slug = "post-3";

        $post->save();

        Post::factory(27)->create();
    }
}
