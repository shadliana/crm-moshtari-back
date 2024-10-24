<?php

namespace Modules\OpportunitiesManagement\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserManagement\app\Models\User;
use Tests\TestCase;
use Modules\OpportunitiesManagement\app\Models\Opportunity;
use Modules\UserManagement\Database\Factories\UserFactory;



class OpportunitiesManagementTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->user = \Modules\UserManagement\Database\Factories\UserFactory::new()->create();
        $this->admin = \Modules\UserManagement\Database\Factories\UserFactory::new()->create();
    }


    public function testIndex()
    {
        Opportunity::factory()->create([
            'title' => 'Test Opportunity',
            'related_customer' => 'Customer A',
            'status' => 'NEW',
            'cost' => 1000,
            'created_by_id'=> auth()->id
        ]);

        $response = $this->actingAs($this->user)->getJson('/api/opportunity/list');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'related_customer', 'status', 'cost'],
                ],
            ]);
    }

    public function testCreateOpportunity()
    {
        $response = $this->actingAs($this->user)->postJson('/api/opportunities/create', [
            'title' => 'New Opportunity',
            'related_customer' => 'Customer B',
            'cost' => 2000,
            'created_by_id'=> auth()->id,
            'status' => 'NEW',
        ]);

        $response->assertStatus(201)
            ->assertJson(['success' => true]);
    }

    public function testUpdateOpportunity()
    {
        $opportunity = Opportunity::factory()->create();

        $response = $this->actingAs($this->user)->putJson('/api/opportunities/update' . $opportunity->id, [
            'title' => 'Updated Opportunity',
            'related_customer' => 'Updated Customer',
            'cost' => 2500,
            'status' => 'WON',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function testDestroyOpportunity()
    {
        $opportunity = Opportunity::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson('/api/opportunities/delete' . $opportunity->id);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function testChangeStatus()
    {
        $opportunity = Opportunity::factory()->create();

        $this->actingAs($this->admin);

        $response = $this->putJson('/api/opportunities/change-status' . $opportunity->id . '/change-status', [
            'status' => 'WON',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }
}
