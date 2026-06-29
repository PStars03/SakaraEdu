<?php

namespace Tests\Feature;

use App\Models\Bootcamp;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_cannot_delete_scholarship(): void
    {
        $admin = User::factory()->admin()->create();
        $scholarship = Scholarship::factory()->create();

        $response = $this->actingAs($admin)->delete('/super-admin/beasiswa/' . $scholarship->id);

        $response->assertForbidden();
        $this->assertDatabaseHas('scholarships', ['id' => $scholarship->id]);
    }

    public function test_super_admin_can_delete_scholarship(): void
    {
        $superAdmin = User::factory()->superAdmin()->create();
        $scholarship = Scholarship::factory()->create();

        $response = $this->actingAs($superAdmin)->delete('/super-admin/beasiswa/' . $scholarship->id);

        $response->assertRedirect();
        $this->assertSoftDeleted('scholarships', ['id' => $scholarship->id]);
    }

    public function test_admin_cannot_delete_bootcamp(): void
    {
        $admin = User::factory()->admin()->create();
        $bootcamp = Bootcamp::factory()->create();

        $response = $this->actingAs($admin)->delete('/super-admin/bootcamp/' . $bootcamp->id);

        $response->assertForbidden();
        $this->assertDatabaseHas('bootcamps', ['id' => $bootcamp->id]);
    }

    public function test_super_admin_can_delete_bootcamp(): void
    {
        $superAdmin = User::factory()->superAdmin()->create();
        $bootcamp = Bootcamp::factory()->create();

        $response = $this->actingAs($superAdmin)->delete('/super-admin/bootcamp/' . $bootcamp->id);

        $response->assertRedirect();
        $this->assertSoftDeleted('bootcamps', ['id' => $bootcamp->id]);
    }

    public function test_free_bootcamp_displays_free_text(): void
    {
        $bootcamp = Bootcamp::factory()->create(['is_paid' => false, 'price' => null]);
        
        $this->assertEquals('Free', $bootcamp->formatted_price);
        
        $response = $this->get('/bootcamp/' . $bootcamp->slug);
        $response->assertSee('Gratis'); // UI displays 'Gratis' (Indonesian for Free)
    }

    public function test_paid_bootcamp_displays_rupiah_price(): void
    {
        $bootcamp = Bootcamp::factory()->create(['is_paid' => true, 'price' => 150000]);
        
        $this->assertEquals('Rp150.000', $bootcamp->formatted_price);
        
        $response = $this->get('/bootcamp/' . $bootcamp->slug);
        $response->assertSee('Rp150.000');
    }
}
