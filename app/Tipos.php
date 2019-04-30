<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    protected $fillable = ['nome', 'descricao', 'tp_habito', 'dt_inicio_ctrl', 'objetivo'];
}
