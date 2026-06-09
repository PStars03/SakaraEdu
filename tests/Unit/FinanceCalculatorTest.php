<?php

namespace Tests\Unit;

use Livewire\Livewire;
use Tests\TestCase;

class FinanceCalculatorTest extends TestCase
{
    public function test_finance_calculator_without_transport_and_rent(): void
    {
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', false)
            ->set('uses_rent', false)
            ->assertSet('percentages.food', 60)
            ->assertSet('percentages.saving', 25)
            ->assertSet('percentages.other', 15)
            ->assertSet('percentages.transport', 0)
            ->assertSet('percentages.rent', 0)
            ->assertSet('amounts.food', 600000)
            ->assertSet('amounts.saving', 250000);
    }

    public function test_finance_calculator_with_transport_only(): void
    {
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', true)
            ->set('uses_rent', false)
            ->assertSet('percentages.food', 55)
            ->assertSet('percentages.transport', 15)
            ->assertSet('percentages.saving', 20)
            ->assertSet('percentages.other', 10)
            ->assertSet('percentages.rent', 0);
    }

    public function test_finance_calculator_with_rent_only(): void
    {
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', false)
            ->set('uses_rent', true)
            ->assertSet('percentages.rent', 35)
            ->assertSet('percentages.food', 45)
            ->assertSet('percentages.saving', 10)
            ->assertSet('percentages.other', 10)
            ->assertSet('percentages.transport', 0);
    }

    public function test_finance_calculator_with_transport_and_rent(): void
    {
        Livewire::test('finance-plan-calculator')
            ->set('scholarship_amount', 1000000)
            ->set('uses_transport', true)
            ->set('uses_rent', true)
            ->assertSet('percentages.rent', 35)
            ->assertSet('percentages.food', 40)
            ->assertSet('percentages.transport', 10)
            ->assertSet('percentages.saving', 10)
            ->assertSet('percentages.other', 5);
    }
}
