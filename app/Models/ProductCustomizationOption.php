<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomizationOption extends Model
{
    use HasFactory;

    protected $table = 'erp_webservice_product_customizations_options';

    protected $fillable = [
        'product_customization_id',
        'name',
        'extra_price',
        'is_available',
    ];

    protected $casts = [
        'extra_price' => 'integer',
        'is_available' => 'boolean',
    ];

    public function customization()
    {
        return $this->belongsTo(ProductCustomization::class, 'product_customization_id');
    }

    public function inventory()
    {
        return $this->morphOne(Inventory::class, 'stockable');
    }
}