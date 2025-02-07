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
        Schema::create('return_items', function (Blueprint $table) {
            $table->bigIncrements('id');                          // Primary key
            $table->unsignedBigInteger('product_return_id');       // Reference to product_return
            $table->unsignedBigInteger('product_id');              // Reference to product
            $table->integer('quantity');                           // Quantity of returned product
            $table->string('salable_status');                      // 'salable' or 'non-salable'
            $table->string('reason')->nullable();                  // Optional reason for return
            $table->decimal('return_amount', 10, 2)->default(0);   // Return amount
            $table->timestamps();          // Item return time
            
            // Foreign key constraints
            $table->foreign('product_return_id')->references('id')->on('product_returns')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};
