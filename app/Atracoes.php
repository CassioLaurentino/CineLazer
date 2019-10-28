<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atracoes extends Model
{
    protected $fillable = ['nome', 'descricao', 'tipo_id', 'faixa_etaria', 'cartaz'];

    public function tipo() {
        return $this->belongsTo('App\Tipos');
    }

    public function sessoes() {
        return $this->hasMany('App\Sessoes');
    }
}
