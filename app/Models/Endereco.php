<?php

namespace App\Models;

use App\Http\Controllers\ImovelControlador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;


    public function dono(){//o endereco pertence a um dono do imovel
        return $this->hasOne(Dono::class);//'App\Models\Proprietario', 'id'
    }

    public function imovel(){
        return $this->hasOne(Imovel::class);
    }
}
