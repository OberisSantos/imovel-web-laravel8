<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;


    public function dono(){//o endereco pertence a um proprietario
        return $this->hasOne(Dono::class);//'App\Models\Proprietario', 'id'
    }

    public function locatario(){//o endereco pertence a um proprietario
        return $this->hasOne(Locatario::class);//'App\Models\Proprietario', 'id'
    }
}
