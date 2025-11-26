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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('customer_id');
            $table->string('vehicle_type_name')->nullable()->after('vehicle_type_id');
            $table->decimal('vehicle_type_amount', 10, 2)->nullable()->after('vehicle_type');
            $table->string('soap_type_name')->nullable()->after('soap_type_id');
            $table->decimal('soap_type_amount', 10, 2)->nullable()->after('soap_type');
            $table->decimal('total_amount', 10, 2)->nullable()->after('soap_type_amount');
            $table->decimal('current_balance', 10, 2)->nullable()->after('total_amount');
            $table->decimal('new_balance', 10, 2)->nullable()->after('current_balance');
            $table->decimal('current_points', 15, 4)->nullable()->after('new_balance');
            $table->decimal('new_points', 15, 4)->nullable()->after('current_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'vehicle_type',
                'vehicle_type_amount',
                'soap_type',
                'soap_type_amount',
                'total_amount',
                'current_balance',
                'new_balance',
                'current_points',
                'new_points',
            ]);
        });
    }
};
