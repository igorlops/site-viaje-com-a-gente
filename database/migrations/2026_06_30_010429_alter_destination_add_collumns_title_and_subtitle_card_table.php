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
            $table->string('title_card')->nullable()->after('slug');
            $table->string('subtitle_card')->nullable()->after('title_card');
            $table->string('text_label_banner')->nullable()->after('subtitle_card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('title_card');
            $table->dropColumn('subtitle_card');
            $table->dropColumn('text_label_banner');
        });
    }
};
