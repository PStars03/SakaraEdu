<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bootcamp extends Model
{
    /** @use HasFactory<\Database\Factories\BootcampFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'organizer',
        'start_date',
        'end_date',
        'location',
        'description',
        'requirements',
        'curriculum',
        'poster',
        'registration_link',
        'status',
        'is_paid',
        'price',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_paid' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function getFormattedPriceAttribute(): string
    {
        if (! $this->is_paid) {
            return 'Free';
        }

        return 'Rp' . number_format((float) $this->price, 0, ',', '.');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
