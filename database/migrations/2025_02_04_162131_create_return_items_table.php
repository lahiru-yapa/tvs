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
            $table->id('return_item_id'); // Primary key
            $table->unsignedBigInteger('return_id'); // Foreign key to returns table
            $table->unsignedBigInteger('product_id'); // Foreign key to products table
            $table->integer('quantity'); // Quantity of the returned product
            $table->decimal('unit_price', 10, 2); // Unit price at the time of purchase
            $table->string('reason'); // Reason for returning this specific item
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('return_id')->references('return_id')->on('returns')->onDelete('cascade');
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
