<?php

namespace Tests\Feature;

use App\Models\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SnippetTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Snippet::factory()->count(23)->create();
    }

    /**
     * Test getting a collection of snippets
     *
     * @return void
     */
    public function testCollectionPageOne()
    {
        $response = $this->json('GET', '/api/snippets');

        $response->assertJsonStructure(
            [
                'current_page',
                'data' => [
                    "*" => [
                        'id',
                        'code',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'from',
                'per_page',
                'to',
                'total',
            ]
        );

        $response->assertJsonPath('current_page', 1);
        $response->assertJsonPath('from', 1);
        $response->assertJsonPath('to', 15);
        $response->assertJsonPath('total', 23);

        $response->assertStatus(200);
    }

    /**
     * Test getting page 2
     *
     * @return void
     */
    public function testCollectionPageTwo()
    {
        $response = $this->json('GET', '/api/snippets/?page=2');

        $response->assertJsonStructure(
            [
                'current_page',
                'data' => [
                    "*" => [
                        'id',
                        'code',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'from',
                'per_page',
                'to',
                'total',
            ]
        );

        $response->assertJsonPath('current_page', 2);
        $response->assertJsonPath('from', 16);
        $response->assertJsonPath('to', 23);
        $response->assertJsonPath('total', 23);

        $response->assertStatus(200);
    }
}
