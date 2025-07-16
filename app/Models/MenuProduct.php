<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuProduct extends Model
{
    use HasFactory;

    protected $table = 'erp_webservice_menu_products';

    protected $fillable = [
        'menu_category_id',
        'name',
        'description',
        'ingredients',
        'base_price',
        'estimated_time_min',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'base_price' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function customizations()
    {
        return $this->hasMany(ProductCustomization::class, 'menu_product_id');
    }

    public function inventory()
    {
        return $this->morphOne(Inventory::class, 'stockable');
    }
}
