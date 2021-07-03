<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasareceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contasareceber', function (Blueprint $table) {
            $table->id();
            $table->date('vencimento');
            $table->date('pagamento')->nullable();
            $table->double('valor_recebido', 4,2)->nullable();
            $table->foreignId('contrato_id')
            ->constrained()
            ->onDelete('cascade');
            $table->enum('status',['pago', 'aguardando']);
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
        Schema::dropIfExists('contasareceber');
    }
}
