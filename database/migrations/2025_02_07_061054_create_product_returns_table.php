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
        Schema::create('product_returns', function (Blueprint $table) {
            $table->bigIncrements('id');                         // Primary key
            $table->unsignedBigInteger('shop_id');               // Reference to shop
            $table->unsignedBigInteger('invoice_id')->nullable(); // Reference to invoice
            $table->timestamp('return_date')->useCurrent();       // Date of return
            $table->string('salable_status')->default('salable'); // Overall status (salable or non-salable)
            $table->decimal('total_amount', 10, 2)->default(0);   // Total amount of the return
            $table->timestamps();        // Creation time
            
            // Foreign key constraints
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_returns');
    }
};
