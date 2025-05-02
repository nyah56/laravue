<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_unauth_request(): void
    {
        $response = $this->getJson('/api/products')
            ->assertStatus(401);
    }
    public function test_list_product(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/products');

        $response->assertStatus(200);
    }
}
