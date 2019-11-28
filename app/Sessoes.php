<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessoes extends Model
{
    protected $fillable = ['local', 'atracao_id', 'data', 'hora', 'sala_id', 'numero_de_poltronas', 'display'];

    public function atracao() {
        return $this->belongsTo('App\Atracoes');
    }

    public function sala() {
        return $this->belongsTo('App\Salas');
    }

    protected $casts = [
        'numero_de_poltronas' => 'array'
    ];
}
