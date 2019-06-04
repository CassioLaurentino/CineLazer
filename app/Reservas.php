<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $fillable = ['user_id', 'session_id', 'poltrona'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function sessao() {
        return $this->belongsTo('App\Sessoes');
    }
}
