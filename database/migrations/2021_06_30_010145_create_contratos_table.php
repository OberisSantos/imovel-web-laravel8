<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('locatario_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('imovel_id')
            ->references('id')
            ->on('imoveis')
            ->constrained()
            ->onDelete('cascade');

            $table->date('inicio')->nullable();
            $table->date('fim')->nullable();
            $table->enum('tipo',['Aluguel']);
            $table->double('valor_mensal', 6, 2);
            $table->integer('dia_pagamento');
            $table->enum('situacao', ['Aberto', 'Finalizado', 'Pendente']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
