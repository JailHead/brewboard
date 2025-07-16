<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomization extends Model
{
    use HasFactory;

    protected $table = 'erp_webservice_product_customizations';

    protected $fillable = [
        'menu_product_id',
        'name',
        'required',
    ];

    protected $casts = [
        'required' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(MenuProduct::class, 'menu_product_id');
    }

    public function options()
    {
        return $this->hasMany(ProductCustomizationOption::class, 'product_customization_id');
    }
}