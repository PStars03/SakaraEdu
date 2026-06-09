<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipFinancePlan extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'scholarship_amount',
        'uses_transport',
        'uses_rent',
        'rent_percentage',
        'food_percentage',
        'transport_percentage',
        'saving_percentage',
        'other_percentage',
    ];

    protected $casts = [
        'scholarship_amount' => 'decimal:2',
        'uses_transport' => 'boolean',
        'uses_rent' => 'boolean',
        'rent_percentage' => 'integer',
        'food_percentage' => 'integer',
        'transport_percentage' => 'integer',
        'saving_percentage' => 'integer',
        'other_percentage' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
