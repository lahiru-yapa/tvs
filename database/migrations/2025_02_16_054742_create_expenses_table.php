<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->string('expense_type'); // Rent, Salary, Utilities, etc.
        $table->decimal('amount', 15, 2);
        $table->date('expense_date');
        $table->string('paid_by')->nullable(); // Cash, Bank Transfer, etc.
        $table->text('description')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Admin who added it
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
