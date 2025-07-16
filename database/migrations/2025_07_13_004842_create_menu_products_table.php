<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erp_webservice_menu_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->constrained('erp_webservice_menu_categories');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->integer('base_price');
            $table->integer('estimated_time_min');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erp_webservice_menu_products');
    }
};