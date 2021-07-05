<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locatarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf', 14)->unique();
            $table->string('email')->unique();
            $table->string('rg')->nullable();

            $table->foreignId('endereco_id')
            ->references('id')
            ->on('enderecos')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('contato_id')
            ->references('id')
            ->on('contatos')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('dono_id')
            ->references('id')
            ->on('donos')
            ->constrained()
            ->onDelete('cascade');
            /*
            $table->foreignId('perfil_id')->nullable()
            ->references('id')
            ->on('perfis')
            ->constrained()
            ->onDelete('cascade');*/

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
        Schema::dropIfExists('locatarios');
    }
}
