<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'quantity',
        'minimum_stock',
        'unit_price',
        'supplier',
        'expiry_date',
        'status',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'unit_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($item) {
            if ($item->quantity <= 0) {
                $item->status = 'out_of_stock';
            } elseif ($item->quantity <= $item->minimum_stock) {
                $item->status = 'low_stock';
            } elseif ($item->expiry_date && $item->expiry_date->isPast()) {
                $item->status = 'expired';
            } else {
                $item->status = 'in_stock';
            }
        });
    }
}
