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
        Schema::create('destination_itinerary_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_day_id')->constrained('destination_itinerary_days')->onDelete('cascade');
            $table->string('activity');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_itinerary_activities');
    }
};
