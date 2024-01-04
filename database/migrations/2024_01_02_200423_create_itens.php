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
        Schema::create('itens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('nome');
            $table->integer('status')->comment('0 -> aberto, 1 -> fechado');
            $table->dateTime('previsao');
            $table->dateTime('conclusao');
            $table->foreignId('lista_id')->references('id')->on('listas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens');
    }
};
