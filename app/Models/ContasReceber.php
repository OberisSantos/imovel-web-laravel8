<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasReceber extends Model
{
    use HasFactory;

    protected $table = 'contasareceber';

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }

    public static function setConta(Contrato $contrato)
    {
        $cr = new ContasReceber();
        $cr->contrato()->associate($contrato->id);
        $cr->valor_recebido = $contrato->valor_mensal;
        $cr->vencimento = '2021-07-05';
        $cr->status = 'Aguardando';

        $cr->save();
    }
}
