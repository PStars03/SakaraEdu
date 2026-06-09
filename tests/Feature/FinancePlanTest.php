<?php

namespace Tests\Feature;

use App\Models\ScholarshipFinancePlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinancePlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_finance_plan(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        
        $this->actingAs($user);

        $response = $this->post(route('uang-beasiswa.store'), [
            'title' => 'Rencana Beasiswa',
            'scholarship_amount' => 5000000,
            'uses_transport' => 0,
            'uses_rent' => 0,
            'rent_percentage' => 0,
            'food_percentage' => 60,
            'transport_percentage' => 0,
            'saving_percentage' => 25,
            'other_percentage' => 15,
        ]);

        $response->assertRedirect(route('uang-beasiswa.index'));
        $this->assertDatabaseHas('scholarship_finance_plans', [
            'user_id' => $user->id,
            'title' => 'Rencana Beasiswa',
            'scholarship_amount' => 5000000,
        ]);
    }

    public function test_user_cannot_access_another_users_finance_plan(): void
    {
        $user1 = User::factory()->create(['role' => 'user']);
        $user2 = User::factory()->create(['role' => 'user']);
        
        $plan = ScholarshipFinancePlan::create([
            'user_id' => $user1->id,
            'title' => 'Rencana User 1',
            'scholarship_amount' => 5000000,
            'uses_transport' => false,
            'uses_rent' => false,
            'rent_percentage' => 0,
            'food_percentage' => 60,
            'transport_percentage' => 0,
            'saving_percentage' => 25,
            'other_percentage' => 15,
        ]);

        $this->actingAs($user2);

        // Attempt to show plan belonging to user1
        $response = $this->get(route('uang-beasiswa.show', $plan->id));
        $response->assertStatus(404);

        // Attempt to edit plan belonging to user1
        $response = $this->get(route('uang-beasiswa.edit', $plan->id));
        $response->assertStatus(404);
        
        // Attempt to update plan belonging to user1
        $response = $this->put(route('uang-beasiswa.update', $plan->id), [
            'title' => 'Hacked',
        ]);
        $response->assertStatus(404);

        // Attempt to delete plan belonging to user1
        $response = $this->delete(route('uang-beasiswa.destroy', $plan->id));
        $response->assertStatus(404);
    }
}
