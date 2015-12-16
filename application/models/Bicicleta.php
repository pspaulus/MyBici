<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    protected $table = 'BICICLETA';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'PUESTO_ALQUILER_id', 'TIPO_id', 'ESTADO_id'
    ];
}