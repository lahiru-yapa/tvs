<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name'); // Name of the shop
            $table->string('phone'); // Name of the shop
            $table->text('address')->nullable(); // Address of the shop
            $table->text('note')->nullable();
            $table->decimal('credit_limit', 10, 2); // Maximum credit limit for the shop
            $table->decimal('current_balance', 10, 2)->default(0.00); // Remaining balance
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
