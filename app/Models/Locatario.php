<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\Model;

class Locatario extends Model
{
    use HasFactory;

    protected $table = 'locatarios';

    public function endereco() //proprietario tem um endereco
    {
        return $this->belongsTo(Endereco::class);//'App\Models\Endereco'

    }

    public function contato()
    {
        return $this->belongsTo(Contato::class); //preciso trazer a chave
    }

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }
}
