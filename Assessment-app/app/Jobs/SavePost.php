<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use Faker\Factory as FakerFactory;
use App\Models\User;

class SavePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Get a random post from the database.
        $response = Http::withoutVerifying()
                       ->get('https://jsonplaceholder.typicode.com/posts/' . rand(1, 100));

        // Fetch one post
        $post = $response->json(); 

        // Check if the post with the same ID already exists in the database
        $existingPost = Post::where('user_id', $post['id'])->first();

        // If the post doesn't exist, it saves the post to the database
        if (!$existingPost) {
            $newPost = new Post();
            $newPost->user_id = $post['id'];
            $newPost->title = $post['title'];
            $newPost->body = $post['body'];

            // Create a new user with random data
            $faker = FakerFactory::create();
            $user = new User();
            $user->name = $faker->userName;
            $user->password = bcrypt('password');
            $user->email = $faker->unique()->safeEmail();
            $user->save();

            $newPost->user_id = $user->id;

            $newPost->save();
        }
}
}
