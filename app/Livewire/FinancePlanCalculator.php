<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ScholarshipFinancePlan;

class FinancePlanCalculator extends Component
{

    public ?ScholarshipFinancePlan $plan = null;
    
    public $title = '';
    public $scholarship_amount = '';
    public $uses_transport = false;
    public $uses_rent = false;
    public $rent_cost = '';       // monthly rent cost (Rp/bulan)
    public $transport_cost = '';  // daily transport cost (Rp/hari)

    public function mount(?ScholarshipFinancePlan $plan = null)
    {
        if ($plan && $plan->exists) {
            $this->plan = $plan;
            $this->title = $plan->title;
            $this->scholarship_amount = $plan->scholarship_amount;
            $this->uses_transport = $plan->uses_transport;
            $this->uses_rent = $plan->uses_rent;
            $this->rent_cost = $plan->rent_cost ?? '';
            $this->transport_cost = $plan->transport_cost ?? '';
        }
    }

    /**
     * Get the food/saving/other ratio weights based on the active scenario.
     * These come from the AGENTS.md percentage rules but are used as ratios
     * for distributing the remaining budget after deducting rent & transport.
     */
    public function getRemainingRatiosProperty()
    {
        if (!$this->uses_rent && !$this->uses_transport) {
            // Scenario 1: food=60, saving=25, other=15
            return ['food' => 60, 'saving' => 25, 'other' => 15];
        } elseif (!$this->uses_rent && $this->uses_transport) {
            // Scenario 2: food=55, saving=20, other=10
            return ['food' => 55, 'saving' => 20, 'other' => 10];
        } elseif ($this->uses_rent && !$this->uses_transport) {
            // Scenario 3: food=45, saving=10, other=10
            return ['food' => 45, 'saving' => 10, 'other' => 10];
        } else {
            // Scenario 4: food=40, saving=10, other=5
            return ['food' => 40, 'saving' => 10, 'other' => 5];
        }
    }

    /**
     * Calculate total semester amounts for each category.
     * Rent and transport are calculated from nominal inputs.
     * The remaining budget is distributed among food, saving, other using ratios.
     */
    public function getAmountsProperty()
    {
        $total = is_numeric($this->scholarship_amount) ? (float) $this->scholarship_amount : 0;

        // Calculate fixed costs from nominal inputs
        $rentTotal = 0;
        if ($this->uses_rent && is_numeric($this->rent_cost) && $this->rent_cost > 0) {
            $rentTotal = (float) $this->rent_cost * 6; // 6 months
        }

        $transportTotal = 0;
        if ($this->uses_transport && is_numeric($this->transport_cost) && $this->transport_cost > 0) {
            $transportTotal = (float) $this->transport_cost * 180; // 180 days
        }

        // Remaining budget after fixed costs
        $remaining = max(0, $total - $rentTotal - $transportTotal);

        // Distribute remaining among food, saving, other using scenario ratios
        $ratios = $this->remainingRatios;
        $ratioSum = $ratios['food'] + $ratios['saving'] + $ratios['other'];

        $food = $ratioSum > 0 ? ($ratios['food'] / $ratioSum) * $remaining : 0;
        $saving = $ratioSum > 0 ? ($ratios['saving'] / $ratioSum) * $remaining : 0;
        $other = $ratioSum > 0 ? ($ratios['other'] / $ratioSum) * $remaining : 0;

        return [
            'rent' => $rentTotal,
            'food' => $food,
            'transport' => $transportTotal,
            'saving' => $saving,
            'other' => $other,
            'total' => $total,
            'remaining' => $remaining,
        ];
    }

    /**
     * Calculate percentages for each category (for storing in DB).
     */
    public function getPercentagesProperty()
    {
        $amts = $this->amounts;
        $total = $amts['total'];

        if ($total <= 0) {
            return [
                'rent' => 0, 'food' => 0, 'transport' => 0,
                'saving' => 0, 'other' => 0,
            ];
        }

        return [
            'rent' => (int) round(($amts['rent'] / $total) * 100),
            'food' => (int) round(($amts['food'] / $total) * 100),
            'transport' => (int) round(($amts['transport'] / $total) * 100),
            'saving' => (int) round(($amts['saving'] / $total) * 100),
            'other' => (int) round(($amts['other'] / $total) * 100),
        ];
    }

    /**
     * Daily breakdown: total_days = 180 (1 semester).
     */
    public function getDailyAmountsProperty()
    {
        $amts = $this->amounts;
        $totalDays = 180;

        return [
            'food' => $totalDays > 0 ? $amts['food'] / $totalDays : 0,
            'transport' => $totalDays > 0 ? $amts['transport'] / $totalDays : 0,
            'other' => $totalDays > 0 ? $amts['other'] / $totalDays : 0,
        ];
    }

    /**
     * Monthly breakdown: total_months = 6 (1 semester).
     */
    public function getMonthlyAmountsProperty()
    {
        $amts = $this->amounts;
        $totalMonths = 6;

        return [
            'rent' => $totalMonths > 0 ? $amts['rent'] / $totalMonths : 0,
            'food' => $totalMonths > 0 ? $amts['food'] / $totalMonths : 0,
            'transport' => $totalMonths > 0 ? $amts['transport'] / $totalMonths : 0,
            'saving' => $totalMonths > 0 ? $amts['saving'] / $totalMonths : 0,
            'other' => $totalMonths > 0 ? $amts['other'] / $totalMonths : 0,
            'total' => $totalMonths > 0 ? $amts['total'] / $totalMonths : 0,
        ];
    }
}
