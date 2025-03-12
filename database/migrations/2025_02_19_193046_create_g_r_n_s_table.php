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
        Schema::create('g_r_n_s', function (Blueprint $table) {
            $table->id();
        $table->string('grn_number')->unique();
        $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
        $table->date('received_date');
        $table->string('supplier_id');
        $table->text('remarks')->nullable();
        $table->boolean('delete_flag')->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_r_n_s');
    }
};
