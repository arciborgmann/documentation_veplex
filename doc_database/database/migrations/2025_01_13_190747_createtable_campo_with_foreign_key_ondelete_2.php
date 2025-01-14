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
        // Tabela 'campos'
        Schema::create('campo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tabela_id');
            $table->string('nome');
            $table->string('tipo');
            $table->text('descricao')->nullable();
            $table->boolean('is_primary_key')->default(false);
            $table->timestamps();

            $table->foreign('tabela_id')->references('id')->on('tabela')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campo');
    }
};
