<?php

namespace App\Livewire;

use Livewire\Component;

class AiAdvisorForm extends Component
{
    public string $major = '';
    public string $ukt_fee = '';
    public string $monthly_rent = '';
    public string $monthly_consumption = '';
    public string $monthly_transport = '';
    public string $self_fund = '';

    /**
     * Calculate total semester expense for live preview.
     * Formula (FR-B2):
     *   total = ukt_fee + (monthly_rent × 6) + (monthly_consumption × 6) + (monthly_transport × 180)
     */
    public function getTotalExpenseProperty(): float
    {
        $ukt         = is_numeric($this->ukt_fee) ? (float) $this->ukt_fee : 0;
        $rent        = is_numeric($this->monthly_rent) ? (float) $this->monthly_rent : 0;
        $consumption = is_numeric($this->monthly_consumption) ? (float) $this->monthly_consumption : 0;
        $transport   = is_numeric($this->monthly_transport) ? (float) $this->monthly_transport : 0;

        return $ukt + ($rent * 6) + ($consumption * 6) + ($transport * 180);
    }

    /**
     * Surplus or deficit = self_fund - total_expense.
     */
    public function getSurplusDeficitProperty(): float
    {
        $fund = is_numeric($this->self_fund) ? (float) $this->self_fund : 0;

        return $fund - $this->totalExpense;
    }

    /**
     * Whether all required fields have valid numeric values.
     */
    public function getIsReadyProperty(): bool
    {
        return is_numeric($this->ukt_fee)
            && is_numeric($this->monthly_consumption)
            && is_numeric($this->self_fund)
            && $this->self_fund > 0;
    }

    /**
     * Breakdown of each expense component (for the preview table).
     */
    public function getBreakdownProperty(): array
    {
        $rent      = is_numeric($this->monthly_rent) ? (float) $this->monthly_rent : 0;
        $transport = is_numeric($this->monthly_transport) ? (float) $this->monthly_transport : 0;

        return [
            'ukt'         => is_numeric($this->ukt_fee) ? (float) $this->ukt_fee : 0,
            'rent_total'  => $rent * 6,
            'rent_month'  => $rent,
            'cons_total'  => is_numeric($this->monthly_consumption) ? (float) $this->monthly_consumption * 6 : 0,
            'cons_month'  => is_numeric($this->monthly_consumption) ? (float) $this->monthly_consumption : 0,
            'trans_total' => $transport * 180,
            'trans_day'   => $transport,
        ];
    }

    public function render()
    {
        return view('livewire.ai-advisor-form');
    }
}
