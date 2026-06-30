<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bootcamp_id',
        'order_id',
        'amount',
        'status',
        'snap_token',
        'payment_method',
        'payment_info',
    ];

    protected $casts = [
        'payment_info' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class);
    }
}
