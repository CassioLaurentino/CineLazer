<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atracoes extends Model
{
    protected $fillable = ['nome', 'descricao', 'tipo_id', 'faixa_etaria'];

    public function tipo() {
        return $this->belongsTo('App\Tipos');
    }
}
