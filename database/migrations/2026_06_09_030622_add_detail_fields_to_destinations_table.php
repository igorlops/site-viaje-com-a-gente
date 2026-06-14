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
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('banner_image_path')->nullable()->after('image_path');
            $table->string('full_price')->nullable()->after('price');
            $table->string('date_range')->nullable()->after('full_price');
            $table->string('nights')->nullable()->after('date_range');
            $table->string('departure_date')->nullable()->after('nights');
            $table->string('return_date')->nullable()->after('departure_date');
            $table->string('departure_city')->nullable()->after('return_date');
            $table->string('trip_type')->nullable()->after('departure_city');
            $table->json('highlights_icons')->nullable()->after('trip_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'banner_image_path',
                'full_price',
                'date_range',
                'nights',
                'departure_date',
                'return_date',
                'departure_city',
                'trip_type',
                'highlights_icons',
            ]);
        });
    }
};
