<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Symfony\Component\VarDumper\Cloner\Data;

use function PHPSTORM_META\type;

class ContasReceber extends Model
{
    use HasFactory;

    protected $table = 'contasareceber';

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }

    public static function setConta(Contrato $contrato)
    {
        $contrato = Contrato::find($contrato->id);
        if($contrato !=null && $contrato->situacao =='Aberto'){
            $data_pagamento = ($contrato->inicio)->format('Y-m')."-"."$contrato->dia_pagamento";
            //$data_pagamento = Date('Y')."-"."$contrato->inicio"."-"."$contrato->dia_pagamento";
            $fim = ($contrato->fim);
            $inicio = ($contrato->inicio);
            $total_meses = $fim->diff($inicio)->m;
            //echo($data_pagamento);
            for ($i=0; $i < $total_meses; $i++) {
                $cr = new ContasReceber();
                $cr->contrato()->associate($contrato->id);
                $cr->valor_mensal = $contrato->valor_mensal;

                $cr->vencimento = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_pagamento)) . "+$i month"));
                $cr->status = 'Aguardando';

                $cr->save();
            }
        }
    }
}
