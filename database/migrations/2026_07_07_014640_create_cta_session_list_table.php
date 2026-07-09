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
        Schema::create('cta_sessions_list', function (Blueprint $table) {
            // Identificadores e Relacionamentos
            $table->id();
            $table->foreignId('cta_session_id')->nullable()->constrained('cta_sessions')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cta_sessions_list');
    }
};
