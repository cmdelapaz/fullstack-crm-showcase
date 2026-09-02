<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LeadConversionTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_convert_a_lead_to_a_client(): void
    {
        $user = User::factory()->create();
        $lead = Lead::factory()->create([
            'name' => 'Jordan Smith',
            'email' => 'jordan@example.test',
            'status' => 'open',
        ]);

        Sanctum::actingAs($user);

        $this->postJson("/api/leads/{$lead->id}/convert")
            ->assertCreated()
            ->assertJsonPath('data.email', 'jordan@example.test');

        $this->assertDatabaseHas('clients', [
            'email' => 'jordan@example.test',
        ]);

        $this->assertDatabaseHas('leads', [
            'id' => $lead->id,
            'status' => 'converted',
        ]);
    }
}
