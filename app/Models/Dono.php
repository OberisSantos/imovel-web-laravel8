<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dono extends Model
{
    use HasFactory;

    public function endereco() //proprietario tem um endereco
    {
        return $this->belongsTo(Endereco::class);//'App\Models\Endereco'

    }

    public function contato()
    {
        return $this->belongsTo(Contato::class); //trazer a chave
    }
    public function imovel(){
        return $this->hasOne(Imovel::class); //levar a chave
    }

    public function user()
    {
        return $this->belongsTo(User::class); //trazer a chave belongsTo: pertence a um
    }
}
