<?php

namespace Tests\Feature;

use App\Models\Bootcamp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_filter_free_paid_bootcamps(): void
    {
        // Requires Livewire test helpers. We simulate the logic.
        $freeBootcamp = Bootcamp::factory()->create(['title' => 'Gratis A', 'is_paid' => false, 'status' => 'published']);
        $paidBootcamp = Bootcamp::factory()->create(['title' => 'Bayar B', 'is_paid' => true, 'price' => 10000, 'status' => 'published']);

        Livewire::test('public-bootcamp-list')
            ->assertSee('Gratis A')
            ->assertSee('Bayar B')
            ->set('filterPrice', 'free')
            ->assertSee('Gratis A')
            ->assertDontSee('Bayar B')
            ->set('filterPrice', 'paid')
            ->assertDontSee('Gratis A')
            ->assertSee('Bayar B');
    }
}
