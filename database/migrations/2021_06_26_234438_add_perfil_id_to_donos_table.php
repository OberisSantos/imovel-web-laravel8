<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerfilIdToDonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donos', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donos', function (Blueprint $table) {
            //
        });
    }
}
