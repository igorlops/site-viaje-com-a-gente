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
        Schema::create('buttons_banner', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('color');
            $table->string('url');
            $table->string('target');
            $table->integer('order')->nullable();
            $table->foreignId('banner_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buttons_banner');
    }
};
