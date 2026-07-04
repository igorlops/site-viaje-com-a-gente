<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Índices/uniques precisam ser removidos ANTES da coluna correspondente
            $table->dropUnique(['slug']);
            $table->dropSoftDeletes(); // remove a coluna deleted_at

            $table->dropColumn([
                'slug',
                'summary',
                'content',
                'banner_path',
                'status',
                'show_in_menu',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'og_title',
                'og_description',
                'og_image',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('banner_path')->nullable();
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->boolean('show_in_menu')->default(false);

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->softDeletes();
        });
    }
};