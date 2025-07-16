<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erp_webservice_product_customizations_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')
                ->constrained('erp_webservice_menu_categories')
                ->name('fk_products_category_id');
            $table->string('name');
            $table->integer('extra_price')->default(0);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erp_webservice_product_customizations_options');
    }
};