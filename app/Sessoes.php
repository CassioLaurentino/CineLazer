<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Sessoes extends Model
{
    protected $fillable = ['local', 'atracao_id', 'data', 'hora', 'numero_de_poltronas'];

    public function atracao() {
        return $this->belongsTo('App\Atracoes');
    }

    protected $casts = [
        'numero_de_poltronas' => 'array'
    ];

    use Searchable;
    public function searchableAs()
    {
        return 'sessoes_index';
    }
}
