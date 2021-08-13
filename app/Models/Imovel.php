<?php

namespace App\Models;

use App\Http\Controllers\ImovelControlador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table = "imoveis";
    protected $guarded = [];//permitir update

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts  = [
        'valor'=> 'decimal:2',
    ];


    public function endereco(){
        return$this->belongsTo(Endereco::class); //trazer a chave de endereco
    }

    public function dono(){
        return$this->belongsTo(Dono::class); //trazer a chave de dono
    }

    public function imagem()
    {
        return $this->hasMany(Imagem::class); //levar a chave
    }

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }

    public function cliente(){
        return $this->hasMany(Cliente::class); //levar a chave
    }
}
