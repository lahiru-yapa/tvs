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
            Schema::create('customers', function (Blueprint $table) {
                $table->id(); // Primary Key, Auto Increment
                $table->string('name', 255); // Customer name
                $table->string('email', 255)->unique(); // Customer email (unique)
                $table->string('phone', 15); // Customer phone number
                $table->text('address'); // Customer address
                $table->decimal('credit_limit', 10, 2); // Maximum credit allowed
                $table->decimal('outstanding_balance', 10, 2); // Total balance the customer owes
                $table->timestamps(); // created_at and updated_at columns
            });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
