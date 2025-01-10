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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('address')->nullable();
<<<<<<< HEAD
=======
            $table->text('note')->nullable();
            $table->decimal('credit_limit', 10, 2)->default(0.00); // Maximum credit limit for the shop
            $table->decimal('current_balance', 10, 2)->default(0.00); // Remaining balance
>>>>>>> f9bb99cff23205477bb448eaab8dffd686f7a1cc
            $table->timestamps();
            $table->boolean('delete_flag')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
