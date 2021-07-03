<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'inicio'
    ];

    protected $casts  = [
        'valor_mensal'=> 'decimal:2',
        'dia_pagamento'=> 'integer',
    ];

    public function locatario(){
        return $this->belongsTo(Locatario::class);//trazer a chave
    }

    public function imovel(){
        return $this->belongsTo(Imovel::class);//trazer a chave
    }


}
