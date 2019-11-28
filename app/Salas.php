<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    protected $fillable = ['nome', 'colunas', 'fileiras', 'numero_de_poltronas'];
}
