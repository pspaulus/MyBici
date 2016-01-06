<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'EVENTO';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'fecha',
        'descripcion',
        'cantidad_participantes',
        'TIPO_id',
        'ESTADO_id'
    ];
}