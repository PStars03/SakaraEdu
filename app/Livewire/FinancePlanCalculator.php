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

    public function mount(?ScholarshipFinancePlan $plan = null)
    {
        if ($plan && $plan->exists) {
            $this->plan = $plan;
            $this->title = $plan->title;
            $this->scholarship_amount = $plan->scholarship_amount;
            $this->uses_transport = $plan->uses_transport;
            $this->uses_rent = $plan->uses_rent;
        }
    }

    public function getPercentagesProperty()
    {
        $rent = 0;
        $transport = 0;
        $food = 0;
        $saving = 0;
        $other = 0;

        if (!$this->uses_rent && !$this->uses_transport) {
            // Scenario 1
            $food = 60;
            $saving = 25;
            $other = 15;
        } elseif (!$this->uses_rent && $this->uses_transport) {
            // Scenario 2
            $food = 55;
            $transport = 15;
            $saving = 20;
            $other = 10;
        } elseif ($this->uses_rent && !$this->uses_transport) {
            // Scenario 3
            $rent = 35;
            $food = 45;
            $saving = 10;
            $other = 10;
        } else {
            // Scenario 4
            $rent = 35;
            $food = 40;
            $transport = 10;
            $saving = 10;
            $other = 5;
        }

        return [
            'rent' => $rent,
            'food' => $food,
            'transport' => $transport,
            'saving' => $saving,
            'other' => $other,
        ];
    }
    
    public function getAmountsProperty()
    {
        $amount = is_numeric($this->scholarship_amount) ? (float) $this->scholarship_amount : 0;
        $pct = $this->percentages;
        
        return [
            'rent' => ($pct['rent'] / 100) * $amount,
            'food' => ($pct['food'] / 100) * $amount,
            'transport' => ($pct['transport'] / 100) * $amount,
            'saving' => ($pct['saving'] / 100) * $amount,
            'other' => ($pct['other'] / 100) * $amount,
            'total' => $amount,
        ];
    }
}
