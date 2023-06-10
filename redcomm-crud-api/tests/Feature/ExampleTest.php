<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Models\Post;
use Faker\Generator as Faker;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testIndexReturnsDataInValidFormat() {
    
    $this->json('get', 'api/posts')
         ->assertStatus(Response::HTTP_OK)
         ->assertJsonStructure(
             [
                'data' => [
                     '*' => [
                         'id',
                         'uuid',
                         'title',
                         'description',
                         'created_at',
                         'updated_at'
                     ]
                 ]
             ]
         );
  }

  public function testPostIsCreatedSuccessfully() {
    
    $payload = [
        'title' => 'Didin Nur Yahya',
        'description' => 'lorem ipsum',
    ];

    $this->json('post', 'api/post/create', $payload)
         ->assertStatus(200)
         ->assertJsonStructure(
             [
                'data' => [
                    'uuid',
                    'title',
                    'description',
                    'created_at',
                    'updated_at'
                 ]
             ]
         );
    $this->assertDatabaseHas('posts', $payload);
}

public function testPostIsUpdatedSuccessfully() {
    
    
    $postData =
        [
            'uuid' => Str::uuid()->toString(),
            'title' => $this->faker->name,
            'description' => $this->faker->text,
        ];

    $post = Post::create(
        $postData
    );


    $payload = [
        'title' => 'Didin Nur Yahya',
        'description' => 'lorem ipsum',
    ];

    $this->json('post', "api/post/update/$post->uuid", $payload)
         ->assertStatus(200)
         ->assertJsonStructure(
             [
                'data' => [
                    'id',
                    'uuid',
                    'title',
                    'description',
                    'created_at',
                    'updated_at'
                 ]
             ]
         );
    $this->assertDatabaseHas('posts', $payload);

}

public function testPostIsDestroyed() {
    
    $postData =
        [
            'uuid' => Str::uuid()->toString(),
            'title' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    $post = Post::create(
        $postData
    );

    $this->json('destroy', "api/post/destroy/$post->uuid")
                ->assertStatus(204);
}
}
