<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
    */
    public function test_create_post()
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'test post'
        ];
        $response = $this->actingAs($user)->post('/api/posts', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }



    public function test_update_post()
    {
        $user = User::factory()->create();
        $post = Post::create([
            'title' => 'Test post',
        ]);

        $data = [
            'title' => 'Updated post',
        ];

        $response = $this->actingAs($user)->put('/api/posts/' . $post->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }



    public function test_delete_post()
    {
        $user = User::factory()->create();
        $post = Post::create([
            'title' => 'Test Post',

        ]);

        $response = $this->actingAs($user)->delete('/api/posts/' . $post->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

}
