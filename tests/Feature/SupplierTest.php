<?php
namespace Tests\Feature;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index endpoint of SupplierController.
     */
    public function test_unauth_request(): void
    {
        $response = $this->getJson('/api/supplier')
            ->assertStatus(401);
    }
    public function test_can_list_suppliers(): void
    {
        $user = \App\Models\User::factory()->create();
        // $user = \App\Models\User::first();

        // $sqid      = $user->sqid;
        // $firstUser = \App\Models\User::findBySqid('usr_oFZyClNwqI');
        // Supplier::factory()->count(3)->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/supplier');

        $response->assertStatus(200);
    }

    /**
     * Test the store endpoint of SupplierController.
     */
    public function test_can_create_supplier(): void
    {
        $user = \App\Models\User::factory()->create();

        $contacts = [
            ['phone' => '123456789', 'email' => 'test@example.com'],
        ];

        $supplierData = [
            'name'         => 'Test Supplier',
            'company_logo' => 'aa/aa/aa.jpg',
            'address'      => 'Malang',
            'contacts'     => json_encode($contacts),
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/supplier', $supplierData);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test Supplier']);

        // Only check basic fields here
        $this->assertDatabaseHas('suppliers', [
            'name'         => 'Test Supplier',
            'company_logo' => 'aa/aa/aa.jpg',
            'address'      => 'Malang',
        ]);

        // Then assert JSON separately
        $supplier = Supplier::where('name', 'Test Supplier')->first();
        $this->assertNotNull($supplier);

        $this->assertEquals(
            json_encode($contacts),
            $supplier->contacts
        );

    }

    /**
     * Test the show endpoint of SupplierController.
     */
    public function test_can_view_supplier(): void
    {
        $user     = \App\Models\User::factory()->create();
        $supplier = Supplier::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/supplier/{$supplier->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $supplier->name]);
    }

    /**
     * Test the update endpoint of SupplierController.
     */
    public function test_can_update_supplier(): void
    {
        $user     = \App\Models\User::factory()->create();
        $supplier = Supplier::factory()->create([
            'contacts' => json_encode([['phone' => '111', 'email' => 'original@example.com']]),
        ]);

        $updatedContacts = [
            ['phone' => '0987654321', 'email' => 'updated@example.com'],
        ];

        $updatedData = [
            'name'     => 'Updated Supplier',
            'address'  => 'Updated Address',
            'contacts' => json_encode($updatedContacts),
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/supplier/{$supplier->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Supplier']);

        $this->assertDatabaseHas('suppliers', [
            'id'      => $supplier->id,
            'name'    => 'Updated Supplier',
            'address' => 'Updated Address',
        ]);

        $this->assertEquals(
            json_encode($updatedContacts),
            Supplier::find($supplier->id)->contacts
        );
    }

    /**
     * Test the delete endpoint of SupplierController.
     */
    public function test_can_delete_supplier(): void
    {
        $user     = \App\Models\User::factory()->create();
        $supplier = Supplier::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/supplier/{$supplier->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('suppliers', ['id' => $supplier->id]);
    }
}
