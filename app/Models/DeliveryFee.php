<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryFee extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryFeeFactory> */
    use HasFactory;

    protected $fillable = [
        'wilaya',
        'fee_home',
        'fee_office',
    ];

    protected $casts = [
        'fee_home' => 'decimal:2',
        'fee_office' => 'decimal:2',
    ];

    public function getFeeForType(string $type): float
    {
        return (float) ($type === 'office' ? $this->fee_office : $this->fee_home);
    }
}
