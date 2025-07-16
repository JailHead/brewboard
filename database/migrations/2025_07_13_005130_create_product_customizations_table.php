<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erp_webservice_product_customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_product_id')->constrained('erp_webservice_menu_products');
            $table->string('name');
            $table->boolean('required')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erp_webservice_product_customizations');
    }
};