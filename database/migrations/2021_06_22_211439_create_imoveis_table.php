<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['Apartamento', 'Casa', 'Quitinete']);
            $table->enum('garagem',['sim', 'nao']);
            $table->integer('vagas_garagem')->nullable();
            $table->integer('qt_quartos');
            $table->integer('qt_suite');
            $table->double('valor', 5, 2)->nullable();
            $table->enum('status',['Disponivel', 'Alugado', 'Aguardando']);//0-disponivel e 1-alugado, 2-Aguardando

            $table->string('img_perfil')->nullable();
            $table->foreignId('endereco_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('dono_id')
            ->constrained()
            ->onDelete('cascade');
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
        Schema::dropIfExists('imoveis');
    }
}
