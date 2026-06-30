<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiSemesterPlanner extends Model
{
    protected $fillable = [
        'user_id',
        'major',
        'ukt_fee',
        'monthly_rent',
        'monthly_consumption',
        'monthly_transport',
        'self_fund',
        'total_expense',
        'surplus_deficit',
        'ai_response_text',
    ];

    protected $casts = [
        'ukt_fee'             => 'decimal:2',
        'monthly_rent'        => 'decimal:2',
        'monthly_consumption' => 'decimal:2',
        'monthly_transport'   => 'decimal:2',
        'self_fund'           => 'decimal:2',
        'total_expense'       => 'decimal:2',
        'surplus_deficit'     => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the plan has a surplus or deficit.
     */
    public function isSurplus(): bool
    {
        return (float) $this->surplus_deficit >= 0;
    }

    /**
     * Formatted surplus/deficit label for display.
     */
    public function getSurplusDeficitLabelAttribute(): string
    {
        $amount = abs((float) $this->surplus_deficit);
        $formatted = 'Rp ' . number_format($amount, 0, ',', '.');

        return $this->isSurplus()
            ? "Surplus {$formatted}"
            : "Defisit {$formatted}";
    }
}
