<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'erp_inventory';

    protected $fillable = [
        'stockable_id',
        'stockable_type',
        'current_stock',
        'min_stock',
        'max_stock',
    ];

    public function stockable()
    {
        return $this->morphTo();
    }

    public function isLowStock()
    {
        return $this->current_stock <= $this->min_stock;
    }

    public function isOutOfStock()
    {
        return $this->current_stock <= 0;
    }
}