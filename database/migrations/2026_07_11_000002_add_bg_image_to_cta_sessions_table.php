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
        if (!Schema::hasColumn('cta_sessions', 'bg_image')) {
            Schema::table('cta_sessions', function (Blueprint $table) {
                $table->string('bg_image')->nullable()->after('text_color');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('cta_sessions', 'bg_image')) {
            Schema::table('cta_sessions', function (Blueprint $table) {
                $table->dropColumn('bg_image');
            });
        }
    }
};
