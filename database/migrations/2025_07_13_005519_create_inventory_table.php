<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erp_inventory', function (Blueprint $table) {
            $table->id();
            $table->integer('stockable_id');
            $table->string('stockable_type');
            $table->integer('current_stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->integer('max_stock')->default(0);
            $table->timestamps();

            $table->index(['stockable_id', 'stockable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erp_inventory');
    }
};