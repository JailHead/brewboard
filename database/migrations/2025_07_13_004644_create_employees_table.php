<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erp_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('role_id')->constrained('erp_employee_roles');
            $table->string('name');
            $table->string('last_name');
            $table->date('birthdate');
            $table->text('address');
            $table->string('phone');
            $table->string('emergency_contact');
            $table->string('nss');
            $table->datetime('entry_date');
            $table->string('shift');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erp_employees');
    }
};