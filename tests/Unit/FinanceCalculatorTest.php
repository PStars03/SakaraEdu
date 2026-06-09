<?php

namespace Tests\Unit;

use Livewire\Livewire;
use Tests\TestCase;

class FinanceCalculatorTest extends TestCase
{
    public function test_finance_calculator_without_transport_and_rent(): void
    {
        // Scenario 1: No rent, no transport. All money goes to food/saving/other.
        // Ratios: food=60, saving=25, other=15 → percentages of total: 60%, 25%, 15%
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', false)
            ->set('uses_rent', false)
            ->assertSet('amounts.food', 600000)
            ->assertSet('amounts.saving', 250000)
            ->assertSet('amounts.other', 150000)
            ->assertSet('amounts.rent', 0)
            ->assertSet('amounts.transport', 0);
    }

    public function test_finance_calculator_with_transport_only(): void
    {
        // Scenario 2: Transport only at Rp 1000/day → 180,000 total transport
        // Remaining: 1,000,000 - 180,000 = 820,000
        // Ratios: food=55, saving=20, other=10 → sum=85
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', true)
            ->set('uses_rent', false)
            ->set('transport_cost', 1000)
            ->assertSet('amounts.transport', 180000);

        // Verify remaining is split correctly
        $component = Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', true)
            ->set('uses_rent', false)
            ->set('transport_cost', 1000);

        $amounts = $component->get('amounts');
        $remaining = 1000000 - 180000;
        
        $this->assertEqualsWithDelta($remaining * (55 / 85), $amounts['food'], 1);
        $this->assertEqualsWithDelta($remaining * (20 / 85), $amounts['saving'], 1);
        $this->assertEqualsWithDelta($remaining * (10 / 85), $amounts['other'], 1);
    }

    public function test_finance_calculator_with_rent_only(): void
    {
        // Scenario 3: Rent only at Rp 500,000/month → 3,000,000 total rent
        // Remaining: 6,000,000 - 3,000,000 = 3,000,000
        // Ratios: food=45, saving=10, other=10 → sum=65
        $component = Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 6000000)
            ->set('uses_transport', false)
            ->set('uses_rent', true)
            ->set('rent_cost', 500000);

        $amounts = $component->get('amounts');
        $this->assertEquals(3000000, $amounts['rent']);
        
        $remaining = 3000000;
        $this->assertEqualsWithDelta($remaining * (45 / 65), $amounts['food'], 1);
        $this->assertEqualsWithDelta($remaining * (10 / 65), $amounts['saving'], 1);
        $this->assertEqualsWithDelta($remaining * (10 / 65), $amounts['other'], 1);
    }

    public function test_finance_calculator_with_transport_and_rent(): void
    {
        // Scenario 4: Rent Rp 500,000/month + Transport Rp 10,000/day
        // Rent total: 500,000 × 6 = 3,000,000
        // Transport total: 10,000 × 180 = 1,800,000
        // Remaining: 6,000,000 - 3,000,000 - 1,800,000 = 1,200,000
        // Ratios: food=40, saving=10, other=5 → sum=55
        $component = Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 6000000)
            ->set('uses_transport', true)
            ->set('uses_rent', true)
            ->set('rent_cost', 500000)
            ->set('transport_cost', 10000);

        $amounts = $component->get('amounts');
        $this->assertEquals(3000000, $amounts['rent']);
        $this->assertEquals(1800000, $amounts['transport']);
        
        $remaining = 1200000;
        $this->assertEqualsWithDelta($remaining * (40 / 55), $amounts['food'], 1);
        $this->assertEqualsWithDelta($remaining * (10 / 55), $amounts['saving'], 1);
        $this->assertEqualsWithDelta($remaining * (5 / 55), $amounts['other'], 1);
    }

    public function test_finance_calculator_no_cost_input_distributes_all_to_remaining(): void
    {
        // When transport is enabled but no cost is entered, transport total = 0
        // All money goes to food/saving/other using Scenario 2 ratios
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', true)
            ->set('uses_rent', false)
            ->set('transport_cost', '')
            ->assertSet('amounts.transport', 0)
            ->assertSet('amounts.rent', 0);
    }
}
