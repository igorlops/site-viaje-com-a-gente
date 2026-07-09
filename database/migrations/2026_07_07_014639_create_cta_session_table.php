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
        Schema::create('cta_sessions', function (Blueprint $table) {
            // Identificadores e Relacionamentos
            $table->id();
            $table->foreignId('page_id')->nullable()->constrained('pages')->onDelete('cascade');
            
            // Conteúdo Principal
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            
            // Configurações do Botão Principal
            $table->string('button_label')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_target')->default('_self'); // _self ou _blank
            $table->string('button_variant')->default('primary'); // primary, secondary, outline, etc.
            $table->string('button_icon')->nullable(); // Nome do ícone (ex: fa-shopping-cart, lucide:arrow-right)

            // Configurações de um Segundo Botão (Opcional - aumenta muito a conversão)
            $table->string('secondary_button_label')->nullable();
            $table->string('secondary_button_url')->nullable();
            $table->string('secondary_button_target')->default('_self');
            $table->string('secondary_button_variant')->default('secondary');

            // Estilização Visual da Sessão
            $table->string('bg_color')->default('#ffffff'); // Cor de fundo em Hexadecimal
            $table->string('text_color')->default('#000000'); // Cor do texto principal
            $table->string('alignment')->default('center'); // left, center, right
            $table->string('padding_vertical')->default('py-12'); // Classes de espaçamento (Tailwind/Bootstrap)

            // Rastreamento e Marketing
            $table->string('analytics_event_name')->nullable(); // Nome do evento para disparar no GA4/Pixel

            // Controle e Ordenação
            $table->integer('order_position')->default(0); // Caso a página tenha múltiplos blocos
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cta_sessions');
    }
};
