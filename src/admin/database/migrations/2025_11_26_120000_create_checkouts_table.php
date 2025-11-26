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
            $table->string('vehicle_type');
            $table->string('soap_type');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_type', ['balance deduction', 'cash']);
            $table->enum('payment_status', ['pending', 'done'])->default('pending');
            $table->integer('points')->default(0);
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
