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
        'TIPO_id',
        'ESTADO_id'
    ];
}