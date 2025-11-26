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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->uuid('reference');
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types')->cascadeOnDelete();
            $table->foreignId('soap_type_id')->constrained('soap_types')->cascadeOnDelete();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_type', ['BALANCE DEDUCTION', 'CASH']);
            $table->enum('payment_status', ['PENDING', 'DONE'])->default('pending');
            $table->decimal('points', 15, 4)->default(0);
            $table->integer('ratio')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
