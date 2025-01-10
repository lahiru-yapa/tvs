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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Product name
            $table->string('sku')->unique(); // Stock Keeping Unit
            $table->text('description')->nullable(); // Product description
            $table->decimal('price', 10, 2); // Product price
            $table->decimal('sell_price', 10, 2); // Product price
            $table->integer('stock')->default(0); // Quantity in stock
            $table->string('category')->nullable(); // Product category
            $table->string('photo')->nullable(); 
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); // Supplier foreign key
            $table->boolean('delete_flag')->default(0);
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']); // Drop foreign key first
        });
        Schema::dropIfExists('products'); // Then drop the table
    }
};
