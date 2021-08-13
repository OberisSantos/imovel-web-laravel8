<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function imovel(){
        return$this->belongsTo(Imovel::class); //trazer a chave de dono
    }
}
