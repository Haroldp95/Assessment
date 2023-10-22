<?php

namespace Tests\Unit;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Post;
use App\Livewire\CreatePost;

// Test the create Post functionailty.
class CreatePostTest extends TestCase
{
    /** @test */
    public function it_creates_a_new_post()
    {
        // Create a user
        $user = User::factory()->create();

        // Log in the user
        $this->actingAs($user);

        Livewire::test(CreatePost::class)
            ->set('title', 'Test Post Title')
            ->set('body', 'Test Post Body')
            ->call('save');

        // Assert that the post was created
        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'title' => 'Test Post Title',
            'body' => 'Test Post Body',
        ]);
    }
}
