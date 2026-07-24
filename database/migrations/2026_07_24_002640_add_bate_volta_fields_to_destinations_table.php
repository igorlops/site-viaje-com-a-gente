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
        Schema::table('destinations', function (Blueprint $table) {
            $table->text('description')->nullable()->after('subtitle');
            $table->string('departure_location')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('return_time')->nullable();
            $table->string('child_policy')->nullable();
            $table->string('payment_info')->nullable();
            $table->string('urgency_badge')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'departure_location',
                'departure_time',
                'return_time',
                'child_policy',
                'payment_info',
                'urgency_badge',
            ]);
        });
    }
};
